<link rel="stylesheet" href="{{ asset('/vendor/wangEditor-3.1.1/release/wangEditor.min.css') }}">
<div id="app">
        <div class="container-fluid">

            <form class="needs-validation" novalidate>
                <input type="hidden" v-model="id">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-3">
                        <h5>链接</h5>
                        <div>
                            <div class="input-group">
                                <input type="text" class="form-control" v-model="article_link" name="article_link" placeholder="文章链接: https://mp.weixin.qq.com/#/#########" required>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-secondary" v-on:click="query_list">导入</button>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="mb-3">媒体</h5>

                                <div class="custom-control custom-radio custom-control-inline" v-for="medium in media">
                                    <input type="radio" :id="'medium_id_'+medium.id" v-model="medium_id" :value="medium.id" name="'medium_id" class="custom-control-input">
                                    <label class="custom-control-label" :for="'medium_id_'+medium.id">@{{ medium.name }}</label>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <h5>客户</h5>
                        <input type="text" v-model="customer" name="customer" class="form-control" placeholder="客户">
                        <hr>
                        <h5>要求</h5>
                        <textarea v-model="remark" name="customer" class="form-control" placeholder="要求"></textarea>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <h5>文编</h5>
                                <div class="custom-control custom-radio custom-control-inline" v-for="text_editor in text_editors">
                                    <input type="radio" :id="'text_editor_id_'+text_editor.id" v-model="text_editor_id" :value="text_editor.id" name="'text_editor_id" class="custom-control-input">
                                    <label class="custom-control-label" :for="'text_editor_id_'+text_editor.id">@{{ text_editor.nickname }}</label>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <hr>
                                <h5>责编</h5>
                                <div class="custom-control custom-radio custom-control-inline" v-for="responsible_editor in responsible_editors">
                                    <input type="radio" :id="'responsible_editor_id_'+responsible_editor.id" v-model="responsible_editor_id" :value="responsible_editor.id" name="'responsible_editor_id" class="custom-control-input">
                                    <label class="custom-control-label" :for="'responsible_editor_id_'+responsible_editor.id">@{{ responsible_editor.nickname }}</label>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="text-center">
                            <button id="submit" class="btn btn-outline-info btn-lg " type="button" v-on:click="submit">保存</button>
                        </div>


                    </div>
                    <div class="col-md-9">
                        <h5>标题</h5>
                        <input type="text" v-model="title" name="title" id="title" class="form-control" placeholder="文章的标题" required>
                        <hr>
                        <h5 class="mb-3">内容</h5>
                        <div id="content" ref="content"></div>
                    </div>
                </div>
            </form>


            <footer class="my-5 pt-5 text-muted text-center text-small"></footer>
        </div>
</div>

<!-- JS, Popper.js, and jQuery -->
<script src="{{ asset('js/app.js') }}"></script>
<script>
    $("#query_list").click(function () {

    });
    new Vue({
        el: "#app",
        data: {
            id: @json($id  ?? null),
            title: @json($title  ?? null),
            article_link: @json($article_link ?? null),
            media: @json($media ?? null),
            text_editors: @json($text_editors ?? null),
            responsible_editors: @json($responsible_editors),
            responsible_editor_id: @json($responsible_editor_id  ?? 0),
            text_editor_id: @json($text_editor_id  ?? 0),
            medium_id: @json($medium_id  ?? 0),
            customer: @json($customer ?? null),
            remark: @json($remark ?? null),
            editor: null,
            editorData: @json($content  ?? null),
            htmlDOM: null,
        },
        methods: {
            query_list: async function () {
                let that = this;
                let url = '/api/query_list';

                async function queryData() {
                    let resultData = null;
                    // 采集数据，同步请求
                    await axios.post(url, {
                        'article_link': that.article_link
                    })
                        .then((response) => {
                            that.title = response.data.title;
                            that.htmlDOM = response.data.content;
                        })
                        .catch(function(error) {
                            alert(error);
                            console.log(error);
                        });
                    return resultData;
                }
                await queryData();
                // async function
                async function replaceAsync(str, regex, asyncFn) {
                    const promises = [];
                    str.replace(regex, (match, ...args) => {
                        const promise = asyncFn(match, ...args);
                        promises.push(promise);
                    });
                    const data = await Promise.all(promises);
                    return str.replace(regex, () => data.shift());
                }
                const image_regex = /<img [^>]*src=['"]([^'"]+)[^>]*>/g;

                async function imageAsyncFn(match, capture) {
                    async function result() {
                        let image_path = null;
                        let image_link = null;
                        await axios.post('/api/download/image', {
                            'image_url': capture
                        })
                            .then(function(response) {
                                image_path = response.data.image_path;
                                image_link = '/storage/' + image_path;
                            })
                            .catch(function(error) {
                                alert(error);
                            });
                        match = match.replace(/src="[^"]+"/gi,`src="${image_link}"`);
                        return match
                    }
                    return await result();
                }
                const replacedImage = await replaceAsync(that.htmlDOM, image_regex, imageAsyncFn)

                // replacedImage
                // console.log('replacedImage', replacedImage)

                let replaced_html = replacedImage
                // 过滤无用标签
                replaced_html = replaced_html.replace(/<(meta|script|link).+?>/igm, '');
                // 去掉注释
                replaced_html = replaced_html.replace(/<!--.*?-->/mg, '');
                // 过滤 data-xxx 属性
                replaced_html = replaced_html.replace(/\s?data-.+?=('|").+?('|")/igm, '');
                replaced_html = replaced_html.replace(/\s?(class|style)=('|").*?('|")/igm, '');

                console.log('pasteHtml',replaced_html)

                that.editor.txt.html(replaced_html);
            },

            submit: function () {
                const url = '/admin/contents';

                if (this.title === null || this.title.trim() === '') {
                    alert('标题不可为空');
                    return;
                }

                const data = {
                    title: this.title,
                    article_link: this.article_link,
                    media_id: this.medium_id,
                    text_editor_id: this.text_editor_id,
                    responsible_editor_id: this.responsible_editor_id,
                    content: this.editorData,
                    customer: this.customer,
                    remark: this.remark,
                };
                let request = null
                if (this.id) {
                    data['_method'] = 'PUT';
                    request = axios.post(url + '/' + this.id, data);
                } else {
                    request = axios.post(url, data);
                }
                request.then(function(response) {
                    console.log(response);
                    alert('保存成功');
                    window.location.href = '/admin/contents';
                }).catch(function(error) {
                    console.log(error);
                    alert('保存失败');
                });
            },
        },

        mounted() {
            const editor = new window.wangEditor('#content');
            editor.config.pasteTextHandle
            editor.config.height = 800;
            editor.config.pasteFilterStyle = false
            // 配置 onchange 回调函数，将数据同步到 vue 中
            editor.config.onchange = (newHtml) => {
                this.editorData = newHtml
            };
            editor.create();
            this.editor = editor;
            this.editor.txt.html(this.editorData);
            let dom_section = editor.$textElem.elems[0].firstChild.firstChild
            let section_attribute = dom_section.getAttribute('powered-by');

            if (section_attribute === 'xiumi.us') {
                dom_section.remove()
            }
        },

        updated() {
            this.$nextTick(() => {
                // this.editorData = document.getElementById('content').getElementsByClassName('w-e-text')[0].innerHTML;
                // console.log('updated this.editorData', this.editorData)
            })
        }
    });
</script>

<style>
    #submit {
        width: 8rem;
    }
    .w-e-text img {
        cursor: pointer;
        max-width: 70vh;
    }
</style>
