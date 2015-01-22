var session = {};

session.interval = null;

session.start = function (questionId) {
    $('.btn-primary').attr('disabled', 'disabled');
    $('div[for=' + questionId + '] .btn-primary').text('Xin đợi...');
    $.ajax({
        url: './start',
        data: {id: questionId},
        dataType: 'JSON',
        success: function (result) {
            if (result.success) {
                var question = result.question;
                var sess = result.session;

                $('div[for=' + question.id + '] .btn-primary').attr('disabled', 'disabled');
                $('div[for=' + question.id + '] .btn-primary').text('Còn ' + question.time-- + ' giây');
                clearInterval(session.interval);
                session.interval = setInterval(function () {
                    if (question.time < 0) {
                        $('.btn-primary').removeAttr('disabled');
                        $('div[for=' + question.id + '] .btn-info').removeAttr('disabled');
                        $('div[for=' + question.id + '] .btn-info').click(function () {
                            session.stat(sess.id);
                        });
                        $('div[for=' + question.id + '] .btn-primary').text('Làm lại');
                        clearInterval(session.interval);
                        return;
                    }
                    $('div[for=' + question.id + '] .btn-primary').text('Còn ' + question.time-- + ' giây');
                }, 1000);
            } else {
                popup.msg(result.message);
            }
        }
    });
};

session.stat = function (id) {
    $.ajax({
        url: './stat',
        data: {id: id},
        dataType: 'JSON',
        success: function (result) {
            if (result.success) {
                popup.open(
                        'stat',
                        'Kết quả câu hỏi',
                        '<div>'+result.question.content+'</div>\
                        <div class="alert alert-success">Câu trả lời đúng: '+result.question.answer+'</div>\
                        <h4>Trả lời đúng</h4><table id="tbl-true" class="table table-striped table-bordered"><tr><th>STT</th><th>Tên</th><th>Thời gian (giây)</th><th>Câu trả lời</th></tr></table>\
                        <h4>Trả lời sai</h4><table id="tbl-false" class="table table-striped table-bordered"><tr><th>STT</th><th>Tên</th><th>Thời gian (giây)</th><th>Câu trả lời</th></tr></table>',
                        null,
                        'modal-lg'
                        );
                var n = 0;
                var m = 0;
                for(var i = 0; i < result.answers.length; i++){
                    if(result.answers[i].true == 1){
                        n++;
                        $('#tbl-true').append('<tr>\\n\
                            <td>'+n+'</td>\
                            <td>'+result.answers[i].playerName+'</td>\
                            <td>'+ (result.answers[i].time - result.session.startTime) +'</td>\
                            <td>'+ result.answers[i].answer +'</td>\
                        </tr>');
                    }else{
                        m++;
                        $('#tbl-false').append('<tr>\\n\
                            <td>'+m+'</td>\
                            <td>'+result.answers[i].playerName+'</td>\
                            <td>'+ (result.answers[i].time - result.session.startTime) +'</td>\
                            <td>'+ result.answers[i].answer +'</td>\
                        </tr>');
                    }
                }
            } else {
                popup.msg(result.message);
            }
        }
    });
};