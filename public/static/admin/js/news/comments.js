define(["jquery", "easy-admin"], function ($, ea) {

    var init = {
        table_elem: '#currentTable',
        table_render_id: 'currentTableRenderId',
        index_url: 'news.comments/index',
        add_url: 'news.comments/add',
        edit_url: 'news.comments/edit',
        delete_url: 'news.comments/delete',
        export_url: 'news.comments/export',
        modify_url: 'news.comments/modify',
    };

    var Controller = {

        index: function () {
            ea.table.render({
                init: init,
                toolbar: ['refresh', 'delete'],
                cols: [[
                    {type: 'checkbox'},
                    {field: 'id', title: 'id', width: 250, search: false },
                    {field: 'title', title: '标题', search: false },
                    {field: 'content', title: '评论内容', search: false},
                    {field: 'user.nickname', title: '用户', search: false},
                    {field: 'support', title: '点赞', search: false},
                    {field: 'create_time', title: '创建时间', search: 'range'},
                    {width: 250, title: '操作', templet: ea.table.tool, operat: ['delete']},
                ]],
            });

            ea.listen();
        },
        add: function () {
            ea.listen();
        },
        edit: function () {
            ea.listen();
        },
    };
    return Controller;
});
