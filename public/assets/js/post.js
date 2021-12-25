$(function (){

    $('#postContent').summernote({
        height: 300
    });
    var inputTags = document.querySelector("#postTags");

   let tagify = new Tagify(inputTags, {
        originalInputValueFormat: valuesArr => valuesArr.map(item => item.value).join(',')
    });

    inputTags.addEventListener('change', onChange)

    function onChange(e){
        // outputs a String
        console.log(e.target.value)
    }

});