$(function (){

    var quill = new Quill('#editor-container', {
        debug: 'info',
        placeholder: 'Compose an epic...',
        modules: {
            syntax: true,
            toolbar: '#toolbar-container'
        },
        theme: 'snow'
    });

    // var editor = new FroalaEditor('#text-editor', {
    //     height: 250,
    // }, function () {
    //
    // })

    // var toolbarOptions = [
    //     ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
    //     ['blockquote', 'code-block'],
    //
    //     [{ 'header': 1 }, { 'header': 2 }],               // custom button values
    //     [{ 'list': 'ordered'}, { 'list': 'bullet' }],
    //     [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
    //     [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
    //     [{ 'direction': 'rtl' }],                         // text direction
    //
    //     [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
    //     [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
    //
    //     [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
    //     [{ 'font': [] }],
    //     [{ 'align': [] }],
    //     ['link', 'image'],
    //     ['clean']
    //     // remove formatting button
    // ];

    // var options = {
    //     debug: 'info',
    //     placeholder: 'Compose an epic...',
    //     modules: {
    //         toolbar: toolbarOptions
    //     },
    //     readOnly: false,
    //     theme: 'snow'
    // };
    //
    // var editor = new Quill('.editor', options);

});