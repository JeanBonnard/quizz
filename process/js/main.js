let signIn = document.querySelector('#cercle-sign')
let formSign = document.querySelector('#form_sign')
let logIn = document.querySelector('#cercle-log')
let formLog = document.querySelector('#form_log')
let com = document.querySelector('#start')
let quest = document.querySelector('#quest')
let bdResp1 = document.querySelector('#bd-resp-1')
let bdResp2 = document.querySelector('#bd-resp-2')
let gdResp = document.querySelector('#gd-resp')
let score = document.querySelector('#score')
let next = document.querySelector('#next')
let countDownText = document.getElementById("countdown");
let scoreDiv = document.querySelector('#scoreDiv')

let id = document.querySelector('#id').value
let user = document.querySelector('#user').value

signIn.addEventListener('click',function (e){
    formSign.classList.toggle('display')

});
logIn.addEventListener('click',function (e){
    formLog.classList.toggle('display-log')

});
com.addEventListener('click',function (e){
    quest.classList.toggle('display')
    scoreDiv.classList.toggle('display')

    fetch('/mega-quizz/process/php/db_purge.php?id='+id+'&user='+user,{
        method: 'get'
    }).then(()=> {

    })

    let count = 100;
    function timer () {
        if(count > 0){
            countDownText.innerText = count;
            count--;
        } else if(count === 0){
            countDownText.innerText = "Fini";
        }
    };

    setInterval(timer, 1000);

});
function btnEvent(){
    bdResp1.addEventListener('click', function (e){
        bdResp1.setAttribute('style','background-color: rgba(255, 0, 0, 0.45); border: 1px white solid')
        bdResp2.setAttribute('style','background-color: rgba(255, 0, 0, 0.45); border: 1px white solid')
        gdResp.setAttribute('style','background-color: rgba(0, 255, 0, 0.45); border: 1px white solid ')
    })
    bdResp2.addEventListener('click', function (e){
        bdResp1.setAttribute('style','background-color: rgba(255, 0, 0, 0.45); border: 1px white solid')
        bdResp2.setAttribute('style','background-color: rgba(255, 0, 0, 0.45); border: 1px white solid')
        gdResp.setAttribute('style','background-color: rgba(0, 255, 0, 0.45); border: 1px white solid')
    })
    gdResp.addEventListener('click', function (e){
        score.value ++

        let formData = new FormData()
        formData.append('score', score.value)

        fetch('/mega-quizz/process/php/insert_score.php?id='+id+'&user='+user+'&score='+score.value,{
            method: 'post',
            body: formData
        }).then(()=> {

        })
        bdResp1.setAttribute('style','background-color: rgba(255, 0, 0, 0.45); border: 1px white solid ')
        bdResp2.setAttribute('style','background-color: rgba(255, 0, 0, 0.45); border: 1px white solid')
        gdResp.setAttribute('style','background-color: rgba(0, 255, 0, 0.45); border: 1px white solid')
    })
}
function randomCard(){
    let cards = $(".divorder");
    for(let i = 0; i < cards.length; i++){
        let target = Math.floor(Math.random() * cards.length -4) + 4;
        let target2 = Math.floor(Math.random() * cards.length -4) +4;
        cards.eq(target).before(cards.eq(target2));
    }
}




next.addEventListener('click',function (e){
        e.preventDefault()



    fetch('/mega-quizz/process/php/view_questions.php?id='+id+'&user='+user,{
        method: 'post'

    }).then((response)=> {

        return response.text()

    }).then((data)=>{
        quest.innerHTML = data
        bdResp1  = document.querySelector('#bd-resp-1')
        bdResp2 = document.querySelector('#bd-resp-2')
        gdResp = document.querySelector('#gd-resp')
        btnEvent()
        randomCard()

    })
})
btnEvent()
randomCard()

