define(["jquery", "easy-admin"], function ($, ea) {

    var init = {
        table_elem: '#currentTable',
        table_render_id: 'currentTableRenderId',
        index_url: 'news/index',
        add_url: 'news/add',
        edit_url: 'news/edit',
        delete_url: 'news/delete',
        export_url: 'news/export',
        modify_url: 'news/modify',
    };
    const table = layui.table

    var Controller = {

        index: function () {
            ea.table.render({
                init: init,
                search: true,
                toolbar: ['refresh', [{
                    text: '添加',
                    url: init.add_url,
                    method: 'open',
                    auth: 'add',
                    class: 'layui-btn layui-btn-normal layui-btn-sm',
                    icon: 'fa fa-plus',
                    extend: 'data-full="true"',
                }], 'delete'],
                cols: [[
                    {type: 'checkbox'},
                    {field: 'id', title: 'ID', width: 120, edit: 'text', search: false},
                    {field: 'title', title: '标题'},
                    {field: 'cover_img', title: '封面', templet: ea.table.image},
                    {field: 'cate_title', title: '分类', search: false, selectList: [], },
                    {field: 'share', title: '分享', edit: 'text'},
                    {field: 'collect', title: '收藏', edit: 'text'},
                    {field: 'support', title: '点赞', edit: 'text'},
                    {field: 'read_count', title: '阅读', edit: 'text'},
                    {field: 'user_count', title: '注册用户', event: 'checkUserList', style: 'cursor: pointer', templet: function (row) {
                        return '<span style="color: #1E9FFF" title="点击查看用户列表">' + row.user_count + '</span>'
                        } },
                    {field: 'sort', title: '排序', edit: 'text', search: false},
                    {field: 'status', search: 'select', selectList: ["禁用","启用"], title: '状态', templet: ea.table.switch},
                    {field: 'author', title: '作者', search: false},
                    {field: 'create_time', title: '创建时间', search: 'range'},
                    {width: 150, title: '操作', templet: ea.table.tool, operat: [
                        [{
                            text: '编辑',
                            extra: 'name',
                            url: init.edit_url,
                            method: 'open',
                            auth: 'edit',
                            class: 'layui-btn layui-btn-xs layui-btn-success',
                            extend: 'data-full="true"',
                        }],
                            'delete'
                        ]},
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
