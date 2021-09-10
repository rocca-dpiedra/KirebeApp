function allusers(source) {
    checkboxes = document.getElementsByName('users[]');
    for(var i=0, n=checkboxes.length;i<n;i++) {
      checkboxes[i].checked = source.checked;
    }
}

function allpjs(source) {
    checkboxes = document.getElementsByName('projects[]');
    for(var i=0, n=checkboxes.length;i<n;i++) {
      checkboxes[i].checked = source.checked;
    }
}

