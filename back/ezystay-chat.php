<script src="https://cdn1.lncld.net/static/js/av-mini-0.6.4.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
<div id="open-chat">Let's Chat!</div>
<div class="chat-wrap">
    <div id="chat-room" data-id=0>
        <div class="chat-top">
            <div class="chat-title">Welcome To EzyStay!
                <div id="close"></div>
            </div>
        </div>
        <div id="chat-add">
        </div>
        <div class="chat-footer"> <img src='https://secure.gravatar.com/avatar/?s=46&d=mm&r=pg'>
            <div id='input'><textarea id='textbox' placeholder="Type your message here..."></textarea></div>
            <input type="hidden" name="from_id" class="from_id" value="">
            <input type="hidden" name="to_id" class="to_id" value="">
            {{csrf_field()}}
        </div>
    </div>
</div>
<style>
    #open-chat {
        width: 200px;
        position: fixed;
        bottom: 0;
        right: 5px;
        padding: 15px 20px;
        margin: 5px;
        text-align: center;
        line-height: 1.3;
        font-size: 15px;
        font-weight: bold;
        cursor: pointer;
        border: 2px solid #ff751a;
        border-radius: 5px;
        background: white;
        color: #ff751a;
    }
    #open-chat:hover {
        opacity: .95;
        color: white;
        background: #ff751a;
        transition: all 60ms ease;
    }

    #close {
        display: inline-block;
        color: white;
        right: 0px;
        margin-bottom: 25px;
    }

    #close:before {
        content: "\f00d";
        cursor: pointer;
        font-family: FontAwesome;
        color: white;
        font-size: 30px;
        padding-right: 0.5em;
        position: fixed;
        right: 0px;
    }

    #open-chat:active {
        opacity: .75;
        transform: scale(.90);
        transition: all 60ms ease;
    }

    #chat-room {
        overflow: auto;
        overflow-x: hidden;
        float: right;
        border-left: 3px solid rgb(240, 240, 240);
        bottom: 0px;
        display: flex;
        display: -webkit-flex;
        flex-direction: column;
        -webkit-flex-direction: column;
        z-index: 9999;
        background: white;
        border-radius: 5px 5px 5px 5px;
        width: 430px;
        right:-430px;
        height:50%;
        transition: all .1s ease-out;
        position: fixed;
    }

    .timer {
        display: inline;
        color: lightgray;
    }

    .chat-item>img {
        margin: 10px;
    }

    .chat-footer>img {
        margin: 10px;
    }

    textarea:focus {
        border: 3px solid rgba(180, 195, 252, 1);
    }

    textarea {
        border-radius: 3px;
        word-wrap: break-word;
        border: 3px solid #ff751a;
        overflow: auto;
        display: block;
        width: 350px;
        outline: none;
        resize: none;
        height: 50px;
        padding: 0 6px;
    }

    #input {
        margin-left: 5px;
        width: 500px;
        bottom: 0px;
        border-top: solid 3px rgba(243, 243, 243, 1);
    }

    .chat-top {
        background: #ff751a;
        border-radius: 3px 3px 3px 3px;
        padding: 8px 0px;
        border-bottom: solid 1px rgb(219, 223, 226);
    }

    .chat-title {
        display: inline;
        cursor: pointer;
        color: white;
        font-size: 16px;
        line-height: 35px;
    }

    .chat-top:before {
        content: "\f086";
        font-family: FontAwesome;
        color: white;
        font-size: 35px;
        position: relative;
        font-style: normal;
        font-weight: normal;
        text-decoration: inherit;
        margin: 10px;
    }

    .chat-box {
        background: white;
        width: 500px;
        display: inline-block;
    }

    img {
        float: left;
    }

    .text {}

    .name {
        color: rgba(152, 152, 152, 1);
        display: inline-block;
    }

    .chat-item {
        margin: 10px;
    }

    .chat-footer {
        position: fixed;
        z-index: 10000;
        background: white;
        bottom: 0;
        width: 100%;
    }

    .chat-box:hover {
        background: rgba(249, 249, 249, 1);
    }
</style>
<script>
    $(document).ready(function() {
        var to_id = '';
        var from_id = '';
        var user_message = 0;
        var Post = AV.Object.extend('Blog');
        var item = $('#chat-room').data('id');
        var username = $.cookie('name');
        if (username==null)
        {
            username='A2sa';
        }
        setInterval(chat, 1000);
        $('#input').keydown(function(e) {
            if (e.keyCode == 13) {
                post();
            }
        });
        function post() {
            var query = new AV.Query(Post);
            var mydate =new Date();
            var str = "" + mydate.getFullYear() + "/";
            str += (mydate.getMonth()+1) + "/";
            str += mydate.getDate();
            query.get(getUrlParam('id')).then(function(post) {
                post.increment('count');
                post.save().then(function() {
                    post.add('Time', str);
                    post.add('Poster', username);
                    post.add('Text', $('#textbox').val() );
                    post.save().then(function() {
                        $('#textbox').val('');
                    }, function(error) {
                        // something
                    });
                }, function(erro) {
                    // something
                });

            }, function(error) {
                // something
            });
            var message = $("#textbox").val();
            $.ajax({
                url:"saveChatUser",
                type:"post",
                data:{data:message,_token:$('[name="_token"]').val(),to_id:to_id,from_id:from_id},
                cache:false,
                success:function(response)
                {
                    from_id = response[0];
                    to_id = response[1];
                    loadMessages();
                },
                error:function(response)
                {
                    console.log(response);
                }
            });

            var html = " <div class='chat-box'><div class='chat-item'><div class='timer'>" + str + "</div><div class='text'>" + $('#textbox').val() + "</div></div></div>"
            $('#chat-add').append(html);
            $("#textbox").val('');

            item++;
            $('#chat-room').scrollTop($('#chat-room')[0].scrollHeight);

        }
        $('#open-chat').click(function() {
            $('#chat-room').css('right', '0px');
            $('#close').show();
            $('#open-chat').hide();
        });
        $('#close').click(function() {
            $('#chat-room').css('right', '-530px');
            $('#open-chat').show();
            $('#close').hide();
        });

        function chat() {
            var query = new AV.Query('Blog');
            query.get(getUrlParam('id')).then(function(object) {
                var id = object.get('count');
                if (item != id+1) {
                    var text=object.get('Text');
                    var time=object.get('Time');
                    var poster=object.get('Poster');
                    console.log(poster[0]);
                    for (item; item <= id; item++) {
                        var html = " <div class='chat-box'><div class='chat-item'><div class='timer'>" + time[item]+ "</div><div class='text'>" + text[item] + "</div></div></div>"
                        $('#chat-add').append(html);
                        $('#chat-room').scrollTop($('#chat-room')[0].scrollHeight);
                    }
                }
            }, function(error) {});

        }

        function login(username) {

            $.cookie('name', username, {
                expires: 7,
                path: "/"
            });
            alert('hi' + $.cookie('name'));
        }



        function loadMessages()
        {
            setInterval(function()
            {
                $.ajax({
                    type:"get",
                    url:"getExecutiveMessages",
                    data:{from_id:from_id,to_id:to_id},
                    dataType:"json",
                    success:function(response)
                    {
                        if(response.length>user_message){
                            var html = '';
                            for(i=user_message;i<response.length;i++){
                                var item = response[i];

                                var html = " <div class='chat-box'>" +
                                        "<div class='chat-item'>" +
                                        "<div class='timer'>" +item.created_at+ "</div>" +
                                        "<div class='text exe-message'>" +  item.message + "</div></div></div>"
                            }
                            $('#chat-add').append(html);
                            user_message = response.length;
                        }
                    }
                });
            }, 1000);//time in milliseconds
        }
    });

    function getUrlParam(name) {
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
        var r = window.location.search.substr(1).match(reg);
        if (r != null) return unescape(r[2]);
        return null;
    }
</script>