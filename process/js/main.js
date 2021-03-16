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

signIn.addEventListener('click',function (e){
    formSign.classList.toggle('display')

});
logIn.addEventListener('click',function (e){
    formLog.classList.toggle('display-log')

});
com.addEventListener('click',function (e){
    quest.classList.toggle('display')
});
bdResp1.addEventListener('click', function (e){
    bdResp1.setAttribute('style','background-color: red')
    bdResp2.setAttribute('style','background-color: red')
    gdResp.setAttribute('style','background-color: green')
})
bdResp2.addEventListener('click', function (e){
    bdResp1.setAttribute('style','background-color: red')
    bdResp2.setAttribute('style','background-color: red')
    gdResp.setAttribute('style','background-color: green')
})
gdResp.addEventListener('click', function (e){
    score.value ++
    bdResp1.setAttribute('style','background-color: red')
    bdResp2.setAttribute('style','background-color: red')
    gdResp.setAttribute('style','background-color: green')
})

let cards = $(".divorder");
for(let i = 0; i < cards.length; i++){
    let target = Math.floor(Math.random() * cards.length -4) + 4;
    let target2 = Math.floor(Math.random() * cards.length -4) +4;
    cards.eq(target).before(cards.eq(target2));
}

let id = document.querySelector('#id').value
let user = document.querySelector('#user').value

next.addEventListener('click',function (e){
        e.preventDefault()
    fetch('/mega-quizz/process/php/view_questions.php?id='+id+'&user='+user,{
        method: 'post'

    }).then((response)=> {

        return response.text()
        //message.value = ''
        //refresh()
    }).then((data)=>{
        quest.innerHTML = data
        reload_js('/mega-quizz/process/js/main.js');
    })
})

function reload_js(src) {
    $('script[src="' + src + '"]').remove();
    $('<script>').attr('src', src).appendTo('body');
}
