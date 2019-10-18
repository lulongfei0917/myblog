$(function () {
    //data-role = layer 弹出全屏弹窗
    //
    $('body')
        .on('click', 'a.j-layer', function (e) {
            var $this = $(this);
            e.stopPropagation();
            var index = layer.open({
                type: 2,
                title: $this.data('title'),
                content: $this.data('url')
            });
            layer.full(index);
        })
        /* id  参数id
         * title  提示消息
         * url  post url地址
         *  success_url 成功之后跳转地址
         * */
        .on('click','a.del',function (e) {
            e.preventDefault();
            var $this = $(this);
            var url = $this.data('action');
            var id = $this.data('id');
            layer.confirm($this.data('title'), {
                btn: ['确定','取消'] //按钮
            }, function(){
                $.ajax({
                    'type': "POST",
                    'url': url,
                    'data': {id:id},
                    'dataType': 'json',
                    'success': function (json) {
                        if (json && json.code == 10000) {
                            layer.msg(json.msg || '操作成功!', {
                                icon: 1, time: 1000, end: function () {
                                    window.location.reload();
                                }
                            });
                        } else {
                            layer.msg(json.msg || '操作失败!', {icon: 2, time: 1000});
                        }
                    },
                    error: function () {
                        layer.msg('操作发生错误!请联系管理员查看权限！', {icon: 2, time: 1000});
                    }
                });
            });
        })
        .on('click','a.examine',function (e) {
            e.preventDefault();
            var $this = $(this);
            var url = $this.data('action');
            var id = $this.data('id');
            layer.confirm($this.data('title'), {
                btn: ['确定','取消'] //按钮
            }, function(){
                $.ajax({
                    'type': "POST",
                    'url': url,
                    'data': {id:id},
                    'dataType': 'json',
                    'success': function (json) {
                        if (json && json.code == 10000) {
                            layer.msg(json.msg || '操作成功!', {
                                icon: 1, time: 1000, end: function () {
                                    window.location.reload();
                                }
                            });
                        } else {
                            layer.msg(json.msg || '操作失败!', {icon: 2, time: 1000});
                        }
                    },
                    error: function () {
                        layer.msg('操作发生错误!', {icon: 2, time: 1000});
                    }
                });
            });
        })
        .on('click','a.edit',function (e) {
            e.preventDefault();
            var $this = $(this);
            var url = $this.data('url');
            var title = $this.data('title');
            var index = layer.open({
                type: 2,
                title: title,
                content: url
            });
            layer.full(index);
        })
        .on('click','a.add',function (e) {
            e.preventDefault();
            var $this = $(this);
            var url = $this.data('url');
            var title = $this.data('title');
            var index = layer.open({
                type: 2,
                title: title,
                content: url
            });
            layer.full(index);
        })
        //提交表单
        .on('submit','#myForm', function (e){
            e.preventDefault();
            var $this = $(this);
            var data = $this.serialize();
            var url = $this.data('action');
            var success_url = $this.data('success');
            $.ajax({
                'type': "POST",
                'url': url,
                'data': data,
                'dataType': 'json',
                'success': function (json) {
                    if (json.code == 10000) {
                        console.log(222)
                        layer.msg(json.msg || '操作成功!', {
                            icon: 1, time: 1000, end: function () {
                                parent.layer.closeAll();
                                window.location.replace(success_url);

                            }
                        });
                    } else {
                        layer.msg(json.msg || '操作失败!', {icon: 2, time: 1000});
                    }
                },
                error: function () {
                    layer.msg('操作发生错误!', {icon: 2, time: 1000});
                }
            });
        });


});