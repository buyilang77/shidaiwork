<?php

namespace App\Http\Controllers\Api;

use App\Events\ManuscriptStatistics;
use App\Http\Controllers\Controller;
use App\Http\Requests\ManuscriptRequest;
use App\Http\Requests\ManuscriptWorkflowRequest;
use App\Models\Manuscript;
use App\Models\User;
use App\Models\WorkflowManuscript;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManuscriptsWorkflowController extends Controller
{
    /**
     * Update manuscript status.
     * @param ManuscriptWorkflowRequest $request
     * @param Manuscript $manuscript
     * @return JsonResponse
     */
    public function update(ManuscriptWorkflowRequest $request, Manuscript $manuscript): JsonResponse
    {
        $data = $request->validated();
        $update_type = $data['update_type'];
        $status_review = WorkflowManuscript::STATUS_REVIEW;
        $status_receive = WorkflowManuscript::STATUS_RECEIVE;
        switch ($update_type) {
            case 'receive':
                $data['status'] = $status_receive;
                $data['receive_at'] = now()->toDateTimeString();
                break;
            case 'review':
                $data['status'] = $status_review;
                $data['submit_at'] = now()->toDateTimeString();
                break;
        }
        unset($data['update_type']);
        $user_id = $this->user()->id;
        $user_type = $this->user()->type;
        switch ($user_type) {
            case User::TEXT_EDITOR:
                $data['text_editor_id'] = $user_id;
                break;
            case User::ADVANCED_EDITOR:
            case User::WRITING_EDITOR:
                $data['writing_editor_id'] = $user_id;
                break;
        }
        $manuscript->workflow();
        $workflow = $manuscript->workflow;
        $workflow->fill($data);
        if ($workflow->getOriginal('status') === $status_receive && $data['status'] === $status_review) {
            event(new ManuscriptStatistics($manuscript));
        }
        $workflow->update($data);
        return custom_response(null, 103);
    }

    /**
     * @param ManuscriptRequest $request
     * @param Manuscript $manuscript
     * @return JsonResponse
     */
    public function review(ManuscriptRequest $request, Manuscript $manuscript): JsonResponse
    {
        $data = $request->validated();
        $status = (int)$data['status'];
        $workflow = $manuscript->workflow;
        $workflow->status = $status;
        $workflow->reviewer_id = $this->user()->id;
        $workflow->review_at = now()->toDateTimeString();
        if ($status === WorkflowManuscript::STATUS_SUCCESS) {
            $media_db = $this->getMediaDatabase($data['media_id']);
            if ($media_db) {
                $item = [
                    'ChannelID'   => $data['channel_id'],
                    'InfoContent' => $data['content'],
                    'InfoTitle'   => $data['title'],
                    'InfoTime'    => now()->toDateTimeString(),
                    'InfoPicture' => $data['thumbnail'] ?? null,
                    'MemberID'    => 1,
                    'InfoFrom'    => $data['source'],
                    'f1'          => $workflow->workflowTextEditor->name,
                ];
                DB::connection($media_db)->table('info')->insert($item);
            }
        }
        $workflow->save();
        return custom_response(null, 103);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function channel(Request $request): JsonResponse
    {
        $data = $request->validate(['media_id' => 'required|integer']);

        $condition['IsShow'] = 1;
        $condition['IsEnable'] = 1;
        $condition['LanguageID'] = 1;
        $condition['ChannelModelID'] = 30;
        $media_db = $this->getMediaDatabase($data['media_id']);
        if (!$media_db) {
            return custom_response();
        }
        $item = DB::connection($media_db)->table('channel')->where($condition)->get(['ChannelID', 'ChannelName']);
        return custom_response($item);
    }

    /**
     * @param int $media_id
     * @return string
     */
    private function getMediaDatabase(int $media_id): ?string
    {
        $channel = null;
        switch ($media_id) {
            case Manuscript::TIMES:
                $channel = 'times';
                break;
            case Manuscript::HONOR:
                $channel = 'honor';
                break;
            case Manuscript::GOVERNMENT:
                $channel = 'government';
                break;
        }
        return $channel;
    }

    /**
     * @param Manuscript $manuscript
     * @return JsonResponse
     */
    public function cancellation(Manuscript $manuscript): JsonResponse
    {
        $manuscript->workflow()->update(['status' => WorkflowManuscript::STATUS_INIT]);
        return custom_response(null, 103);
    }
}
