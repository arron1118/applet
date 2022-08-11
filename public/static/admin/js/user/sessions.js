define(["jquery", "easy-admin"], function ($, ea) {

    var init = {
        table_elem: '#currentTable',
        table_render_id: 'currentTableRenderId',
        index_url: 'user.sessions/index',
        add_url: 'user.sessions/add',
        edit_url: 'user.sessions/edit',
        delete_url: 'user.sessions/delete',
        export_url: 'user.sessions/export',
        modify_url: 'user.sessions/modify',
    };

    var Controller = {

        index: function () {
            ea.table.render({
                init: init,
                cols: [[
                    {type: 'checkbox'},                    {field: 'id', title: 'id'},                    {field: 'user_id', title: '用户ID'},                    {field: 'ip_address', title: 'ip_address'},                    {field: 'user_agent', title: 'user_agent'},                    {field: 'payload', title: 'payload'},                    {field: 'last_activity', title: 'last_activity'},                    {field: 'user.id', title: ''},                    {field: 'user.nickname', title: '昵称'},                    {field: 'user.realname', title: '真实姓名'},                    {field: 'user.password', title: '密码'},                    {field: 'user.phone', title: '手机号'},                    {field: 'user.header_img', title: '头像', templet: ea.table.image},                    {field: 'user.identifier', title: '身份证'},                    {field: 'user.openid', title: '微信openid'},                    {field: 'user.email', title: '邮箱'},                    {field: 'user.gender', title: '性别'},                    {field: 'user.country', title: '国家'},                    {field: 'user.province', title: '省份'},                    {field: 'user.city', title: '市'},                    {field: 'user.invite_code', title: '邀请码'},                    {field: 'user.status', title: '状态', templet: ea.table.switch},                    {field: 'user.create_time', title: '创建时间'},                    {width: 250, title: '操作', templet: ea.table.tool},
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