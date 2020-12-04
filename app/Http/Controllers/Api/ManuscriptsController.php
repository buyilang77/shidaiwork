<?php

namespace App\Http\Controllers\Api;

use App\Events\ManuscriptStatistics;
use App\Http\Controllers\Controller;
use App\Http\Requests\ManuscriptRequest;
use App\Http\Resources\ManuscriptResource;
use App\Models\Manuscript;
use App\Models\Statistic;
use App\Models\User;
use App\Models\WorkflowManuscript;
use Illuminate\Http\JsonResponse;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ManuscriptsController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $item = QueryBuilder::for(Manuscript::class)
            ->with('workflow')
            ->allowedFilters([
                'title',
                AllowedFilter::exact('workflow.status'),
                AllowedFilter::exact('workflow.reviewer_id'),
                AllowedFilter::exact('workflow.writing_editor_id'),
                AllowedFilter::exact('workflow.text_editor_id'),
            ])
            ->orderByDesc('id')
            ->paginate($this->perPage);
        return custom_response(ManuscriptResource::collection($item)->response()->getData());
    }

    /**
     * @param ManuscriptRequest $request
     * @return JsonResponse
     */
    public function store(ManuscriptRequest $request): JsonResponse
    {
        $data = $request->validated();
        unset($data['is_review']);
        $manuscript = Manuscript::create($data);
        $this->user()->workflowTextEditor()->create(['manuscript_id' => $manuscript->getKey()]);
        event(new ManuscriptStatistics($manuscript));
        return custom_response(null, 101)->setStatusCode(201);
    }

    /**
     * @param ManuscriptRequest $request
     * @param Manuscript $manuscript
     * @return JsonResponse
     */
    public function update(ManuscriptRequest $request, Manuscript $manuscript): JsonResponse
    {
        $data = $request->validated();
        unset($data['status']);
        $manuscript->update($data);
        return custom_response(null, 103);
    }

    /**
     * @param Manuscript $manuscript
     * @return JsonResponse
     */
    public function show(Manuscript $manuscript): JsonResponse
    {
        return custom_response(ManuscriptResource::make($manuscript));
    }

    /**
     * @param Manuscript $manuscript
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(Manuscript $manuscript): JsonResponse
    {
        $manuscript->delete();
        return custom_response()->setStatusCode(204);
    }
}
