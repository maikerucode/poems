<script>
    var selectedAns = null;
    var confirmed = false;
    var correct_submit = false;
    const correctAns = {{ $question->correct_ans }};

    $(document).ready(function() {
        var remainingTime = {{ $difference->h * 3600 + $difference->i * 60 + $difference->s }};
        var invert = {{ $difference->invert }};

        setInterval(function() {
            if (invert == 1) {
                // Handle timer expiration here
                // clearInterval(interval);
                $('#rem_time').text("Time's Up!");
            } else {
                var hours = Math.floor(remainingTime / 3600);
                var minutes = Math.floor((remainingTime % 3600) / 60);
                var seconds = remainingTime % 60;

                $('#rem_time').text('Remaining Time: ' + hours.toString().padStart(2, '0') + ':' + minutes.toString().padStart(2, '0') + ':' + seconds.toString().padStart(2, '0'));

                remainingTime--;
            }
        }, 1000);

    });

    function selectAnswer(id=null, element=null) {
        if (!confirmed) {
            selectedAns = id;
            $('[id^="ans_"]').removeClass('bg-purple-600 text-white');
            $('[id^="ans_"]').addClass('bg-white text-purple-600');
            element.removeClass('bg-white text-purple-600');
            element.addClass('bg-purple-600 text-white');
        }
    }

    function confirmAnswer() {
        confirmed = true;
        if (selectedAns == correctAns) {
            $('#ans_' + selectedAns).removeClass('bg-purple-600 text-white border-purple-600');
            $('#ans_' + selectedAns).addClass('bg-green-600 text-white border-green-600');
            $('#isCorrect').attr('value', true);
        } else {
            $('#ans_' + selectedAns).removeClass('bg-white text-purple-600 border-purple-600');
            $('#ans_' + selectedAns).addClass('bg-red-600 text-white border-red-600');
            $('#ans_' + correctAns).removeClass('bg-white text-purple-600 border-purple-600');
            $('#ans_' + correctAns).addClass('bg-green-600 text-white border-green-600');
            $('#isCorrect').attr('value', false);
        }
        $('.nextQues-btn').removeClass('hidden');
    }

    // class="text-md font-bold card-body rounded-lg bg-white border border-purple-600 text-purple-600 cursor-pointer"

    $('[id^="ans_"]').on('click', function() {
        // console.log($(this).attr('id'));
        let idStr = $(this).attr('id');
        let match = idStr.match(/^ans_(\d+)$/);
        let answer_id = parseInt(match[1]);
        selectAnswer(answer_id, $(this));
    });

    $('.confirm-ans').on('click', function() {
        confirmAnswer();
    });

    $('.nextQues-btn').on('click', function() {
       
    });

</script>