define(["jquery", "easy-admin"], function ($, ea) {    var init = {        table_elem: '#currentTable',        table_render_id: 'currentTableRenderId',        index_url: 'user.news_support/index',        add_url: 'user.news_support/add',        edit_url: 'user.news_support/edit',        delete_url: 'user.news_support/delete',        export_url: 'user.news_support/export',        modify_url: 'user.news_support/modify',    };    var Controller = {        index: function () {            ea.table.render({                init: init,                cols: [[                    {type: 'checkbox'},                    {field: 'id', title: 'id'},                    {field: 'title', title: '新闻标题'},                    {field: 'nickname', title: '点赞用户'},                    {field: 'create_time', title: '创建时间'},                    {width: 250, title: '操作', templet: ea.table.tool},                ]],            });            ea.listen();        },        add: function () {            ea.listen();        },        edit: function () {            ea.listen();        },    };    return Controller;});