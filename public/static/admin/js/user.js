define(["jquery", "easy-admin"], function ($, ea) {

    var init = {
        table_elem: '#currentTable',
        table_render_id: 'currentTableRenderId',
        index_url: 'user/index',
        add_url: 'user/add',
        edit_url: 'user/edit',
        delete_url: 'user/delete',
        export_url: 'user/export',
        modify_url: 'user/modify',
    };

    var Controller = {
        index: function () {
            // 根据新闻来源查看用户
            const from_news = $('table').data('from-news')
            init.index_url = init.index_url + '?from_news=' + from_news

            ea.table.render({
                init: init,
                cols: [[
                    {type: 'checkbox'},
                    {field: 'id', title: 'id', width: 120, search: false},
                    {field: 'nickname', title: '昵称'},
                    {field: 'phone', title: '手机号'},
                    {field: 'header_img', title: '头像', templet: ea.table.image},
                    {field: 'gender', search: 'select', selectList: ["保密","男","女"], title: '性别'},
                    {field: 'news_title', title: '用户来源', search: false},
                    {field: 'status', search: 'select', selectList: ["禁用","启用"], title: '状态', templet: ea.table.switch},
                    {field: 'create_time', title: '创建时间', search: 'range'},
                    {width: 200, title: '操作', templet: ea.table.tool},
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
