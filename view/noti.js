var i = 0;
var check_noti1 = '';
function show(){
    setInterval(function(){
        getJson()
    },2000);
    var tus = localStorage.getItem('permission');
    
    if (tus == 'yes') {
        document.getElementById('tus').innerHTML = '(Đã đăng ký nhận thông báo)';
    }
    else{
        if(confirm("Đăng ký đẩy thông báo") == true){
            permission();
        }
        else{
            document.getElementById('tus').innerHTML = '(Chưa đăng ký nhận thông báo)';
        }
    }
}

function permission(){
    if(window.Notification){
        Notification.requestPermission().then(function(result){
            if(result === 'granted'){
                localStorage.setItem('permission', 'yes');
                document.getElementById('tus').innerHTML = 'Đã cấp quyền đẩy thông báo';
            }
        });
    }
}

function open(url){
    window.location.href = url;
}

function notification(string){
    var notify;
    var title = 'Nhà của tôi';
    var options = {
        body: string,
        icon: 'http://techitvn.com/wp-content/uploads/2016/11/cropped-dffdf-1-192x192.jpg',
        tag: 'http://localhost/noti/'
    }
    
    if(Notification.permission === 'granted'){
        notify = new Notification(title,options);           
        notify.onclick = function(){
            open(notify.tag);
        }
    }
}

function getJson(){
    var noti = '';
    var check_noti = '';
    var change = '';
	$.getJSON('https://techitvn.com/home/view/json.php', function(data) {
        i++;
        for(j=0; j<data.light_status.length; j++){
            if(data.light_status[j].status == '1'){
                change = 'Bật';
            }else{
                change = 'Tắt';
            }
            noti += 'Đèn ' + data.light_status[j].id_light + ': ' + change + '<br>';
            check_noti += 'Đèn ' + data.light_status[j].id_light + ': ' + change + '\n';
        }

        if(check_noti != check_noti1){
            notification(check_noti);
        }
        check_noti1 = check_noti;
        console.log(check_noti + '\n' + check_noti1);
        $("h4").html(noti);
    });
}