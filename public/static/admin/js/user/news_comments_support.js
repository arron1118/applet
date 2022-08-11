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
                cols: [[
                    {type: 'checkbox'},                    {field: 'id', title: 'id'},                    {field: 'comments_id', title: '评论ID'},                    {field: 'user_id', title: '用户ID'},                    {field: 'create_time', title: '创建时间'},                    {field: 'newsComments.id', title: ''},                    {field: 'newsComments.pid', title: ''},                    {field: 'newsComments.news_id', title: '新闻ID'},                    {field: 'newsComments.user_id', title: '用户ID'},                    {field: 'newsComments.content', title: '评论内容'},                    {field: 'newsComments.support', title: '点赞'},                    {field: 'newsComments.create_time', title: '创建时间'},                    {field: 'user.id', title: ''},                    {field: 'user.nickname', title: '昵称'},                    {field: 'user.realname', title: '真实姓名'},                    {field: 'user.password', title: '密码'},                    {field: 'user.phone', title: '手机号'},                    {field: 'user.header_img', title: '头像', templet: ea.table.image},                    {field: 'user.identifier', title: '身份证'},                    {field: 'user.openid', title: '微信openid'},                    {field: 'user.email', title: '邮箱'},                    {field: 'user.gender', title: '性别'},                    {field: 'user.country', title: '国家'},                    {field: 'user.province', title: '省份'},                    {field: 'user.city', title: '市'},                    {field: 'user.invite_code', title: '邀请码'},                    {field: 'user.status', title: '状态', templet: ea.table.switch},                    {field: 'user.create_time', title: '创建时间'},                    {width: 250, title: '操作', templet: ea.table.tool},
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