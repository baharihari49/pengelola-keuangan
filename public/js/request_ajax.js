function reqAjax(methode, url, callback){
    const xhr = new XMLHttpRequest()
    xhr.onload = function(){
        if(this.status === 200) {
            let response = JSON.parse(this.responseText)
            callback(null, response)
        }
    }
    xhr.open(methode, url, true)
    xhr.send()
}

