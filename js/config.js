

// Quill.register('modules/imageResize', QuillResizeModule);
Quill.register('modules/blotFormatter', QuillBlotFormatter.default);
Quill.register('modules/focus', Focus);
Quill.register("modules/imageCompressor", imageCompressor);

Quill.register({
  'modules/tableUI': quillTableUI.default
}, true)



const quill = new Quill('#editor', {
  modules: { toolbar: '#toolbar' },



  theme: 'bubble',
  // placeholder: 'Press ctrl+shift to see the editor toolbar.',
  modules: {

    table: true,
    tableUI: true,





      // imageDrop: true,
      magicUrl: true,

      focus: {
        focusClass: 'focused-blot' // Defaults to .focused-blot.
      },

      // imageResize: {
      //   displaySize: true
      // },

      blotFormatter: {
        // see config options below
      },




      imageCompressor: {
        quality: 0.9,
        maxWidth: 617, // default
        maxHeight: 617, // default
        imageType: 'image/jpeg'
      },




      
    toolbar: [
    //   [{ 'align': [] }],
    //   [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

    //   ['image', 'video','link'],

    //   ['bold', 'italic', 'underline', 'strike'],        // toggled buttons

    //   ['blockquote', 'code-block'],
      

    //   // [{ 'header': 1 }, { 'header': 2 }],               // custom button values
    //   [{ 'list': 'ordered'}, { 'list': 'bullet' }, { 'list': 'check' }],
    //   // [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
    //   [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
    //   // [{ 'direction': 'rtl' }],                         // text direction

    //   // [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
      

    //   [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
    //   // [{ 'font': [] }],
      

    //   ['clean']                                         // remove formatting button
    // ]






    
      ['bold', 'italic'],
      ['image', 'video', 'link'],
      [{ 'header': 3 }, { 'header': 4 }],
      
      
      ['blockquote'],
      [{ 'align': [] }],
      ['clean']                                        
    ]
  }
});



