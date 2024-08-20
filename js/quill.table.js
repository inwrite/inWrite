const table = quill.getModule('table');
document.querySelector('#insert-table').addEventListener('click', function() {
  table.insertTable(3, 3);
});