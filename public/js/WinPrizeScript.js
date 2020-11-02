function getPrize()
{

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type:'POST',
        url:'WinPrizeController',
        success:function (data) {
            var str = 'congratulations you won ' + data.money + ' ' + data.typeid;
            $('#msg').html(str);
            if (data.typeid == 1) {
                $('#converting').css('display', 'block');
            } else {
                $('#converting').css('display', 'none');
            }
            window.wincash = data;
            $('#depositmess').css('display', 'block');
            $('#write').css('display', 'block');
        }
    });
}

function ConvertPrize(money)
{
        $.ajax({
            type: 'GET',
            url: 'convert',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            data: (money),
            success: function (data) {
                if (data) {
                    $('#converting').remove();
                    var str = 'you converted your money won for ' + data.money + ' points';
                    $('#conv').html(str).css('display', 'block');
                    window.wincash = data;
                    $('#depositmess').css('display', 'block');
                    $('#write').css('display', 'block');
                } else {
                    alert(data);
                }
            },
            error: function () {
                alert(data.message);
            }
        });
}

function WritePrize(money)
{
    console.log(money);

        console.log("money");
        $.ajax({
            type: 'GET',
            url: 'createwin',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            data: (money),
            success: function (data) {
                console.log('ok');
                console.log(data);
                if (data) {
                    $('#write').remove();
                    console.log(data.message);
                } else {
                    alert(data.message);
                }
            }
        });

}
