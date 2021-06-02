<script>
         function timeSince(date) {

              var seconds = Math.floor((new Date() - date) / 1000);

              var interval = Math.floor(seconds / 31536000);

              if (interval > 1) {
                return interval + " années";
              }
              interval = Math.floor(seconds / 2592000);
              if (interval > 1) {
                return interval + " mois";
              }
              interval = Math.floor(seconds / 86400);
              if (interval > 1) {
                return interval + " jours";
              }
              interval = Math.floor(seconds / 3600);
              if (interval > 1) {
                return interval + " heures";
              }
              interval = Math.floor(seconds / 60);
              if (interval > 1) {
                return interval + " minutes";
              }
              return Math.floor(seconds) + " secondes";
            }

            setInterval(function(){
                $.ajax({
                    url: '{!!URL::route('getNotifs')!!}',
                    type: 'GET',
                    dataType: 'json',

                    success:function(data){

                        $('.notification-list').html('')
                        var liStyle = "";
                        var bodyStyle = "";
                        for(var i in data){
                            if(data[i].status === 0){
                             liStyle = 'style = "background: #eee !important;"'
                             bodyStyle = 'style = "font-weight: bold !important"'
                            }else{
                               liStyle = "";
                               bodyStyle = "";
                            }
                            /*$('.notification-message').append('<a href="'+data[i].route+'" class="media notification-message" data-id='+data[i].id+' '+liStyle+'><span class="d-flex"><img alt="" src="'+data[i].profile_picture+'" class="rounded-circle"></span><span class="media-body"><span class="heading-font-family media-heading">' +data[i].sender_name +' '+'</span><span class="media-content"' +bodyStyle+ '>' + data[i].body + '</span><span class="chat-time"> Il y a '+timeSince(new Date(data[i].created_at))+ '</span></span></a>');
                            data[i].unread === 0 ? $('.badge-pill').html('') : $('.badge-pill').html(data[i].unread)*/

                            $('.notification-list').append('<li class="notification-message"> <a href="'+data[i].route+'" data-id='+data[i].id+' '+liStyle+'><div class="media"><span class="avatar avatar-sm"><img class="avatar-img rounded-circle" alt="User Image" src="'+data[i].profile_picture+'"></span><div class="media-body"><p class="noti-details"><span class="noti-title">' +data[i].sender_name +' '+'<p class="noti-time"><span class="notification-time">Il y a '+timeSince(new Date(data[i].created_at))+ '</span></p></div></div></a></li>')

                            data[i].unread === 0 ? $('.count').html('') : $('.count').html(data[i].unread)

                        }

                    }
            })
            }, 5000)

             $('.notification-list').delegate('.notification-message','click', function(){
                    $.ajax({
                    url: '{!!URL::route('updateStatus')!!}',
                    type: 'GET',
                    dataType: 'json',
                    data: {_token : "{{ csrf_token() }}", id : $(this).attr('data-id')},
                    success:function(){}
                    })
            })

	</script>