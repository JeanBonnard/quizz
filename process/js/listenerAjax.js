function addEvent(e){
    console.log(e)
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
            addEvent()
        })
    })

}
