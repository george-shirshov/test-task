"use strict";

document.addEventListener('DOMContentLoaded', () => {
  const formAddComment = document.getElementById('formAddComment');
  const formsDeleteComment = document.getElementsByName('formDeleteComment');

  function validateForm() {
    let countError = 0;
    let formReq = document.querySelectorAll('.req');
    let errorMessage = document.getElementsByName('errorMessage');

    function addErrorMessage(i) {
      errorMessage[i].classList.add('error-message');
      countError++;
    }

    formReq.forEach((input, i) => {
      input.classList.remove('error-input');
      errorMessage[i].classList.remove('error-message');

      if (input.getAttribute('type') === 'checkbox') {
        if (!input.checked) {
          addErrorMessage(i);
        }
      } else {
        if (!input.value) {
          input.classList.add('error-input');
          addErrorMessage(i);
        }
      }
    });

    return countError;
  }

  async function send(url, data) {
    await fetch(url, data).then((response) => {
      if (response.ok) {
        location.reload();
      }
    });  
  }

  formAddComment.addEventListener('submit', (e) => {
    e.preventDefault();
    
    let countError = validateForm();

    if (countError !== 0) {
      return;
    }

    let formData = new FormData(formAddComment);
  
    send('../app/create-comment.php', { method: 'POST', body: formData });

    return false;
  });
  
  formsDeleteComment.forEach(form => {
    form.addEventListener('submit', (e) => {
      e.preventDefault();
  
      let formData = new FormData(form);
  
      formData.append(e.submitter.name, e.submitter.value);
  
      send('../app/delete-comment.php', { method: 'POST', body: formData });
      
      return false;
    });
  });

  
});