define(["jquery", "easy-admin"], function ($, ea) {

    var init = {
        table_elem: '#currentTable',
        table_render_id: 'currentTableRenderId',
        index_url: 'user.news_comments_support/index',
        add_url: 'user.news_comments_support/add',
        edit_url: 'user.news_comments_support/edit',
        delete_url: 'user.news_comments_support/delete',
        export_url: 'user.news_comments_support/export',
        modify_url: 'user.news_comments_support/modify',
    };

    var Controller = {

        index: function () {
            ea.table.render({
                init: init,
                toolbar: ['refresh', 'delete', 'export'],
                cols: [[
                    {type: 'checkbox'},
                    {field: 'id', title: 'id'},
                    {field: 'content', title: '评论内容'},
                    {field: 'nickname', title: '点赞用户'},
                    {field: 'create_time', title: '创建时间'},
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
