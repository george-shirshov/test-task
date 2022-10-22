"use strict"

async function send(url, data) {
  try {
    const response = await fetch(url, data);
    return await response.json();
  } catch (error) {
    return {};
  }
}

function validateForm() {
  let countErrors = 0;

  for (let key in this.formAddComment) {
    if (!this.formAddComment.hasOwnProperty(key)) {
      continue;
    }

    this.errors[key] = !Boolean(this.formAddComment[key]);

    if (this.errors[key]) {
      countErrors++;
    }
  }

  return countErrors;
}

function clearFormAddComment() {
  this.formAddComment['userName'] = '';
  this.formAddComment['text'] = '';
  this.formAddComment['сaptcha'] = false;
}

function getLocalDateISOFormatted() {
  const differenceMilliseconds = 60000;
  let date = new Date();
  let dateLocal = new Date(date.getTime() - date.getTimezoneOffset() * differenceMilliseconds);
  return dateLocal.toISOString().slice(0, 19).replace('T', ' ');
}

const App = {
  data: () => ({
    title: 'Рыжий кот',

    image: {
      path: '/public/img/orange-cat.jpg',
      alt: 'Рыжий кот'
    },

    /**
     * Поля формы добавления комментария
    */
    formAddComment: {
      userName: '',
      text: '',
      сaptcha: false
    },

    /**
     * Массив с комментарями.
     * Комментарий имеет поля: id, userName, date, text
     * Аналогичные названия столбцов в базе.
     */
    comments: [],

    /**
     * Объект, показывающий какие поля у 
     * формы добавления комментария незаполнены.
    */
    errors: {
      userName: false,
      text: false,
      сaptcha: false
    }
  }),

  methods: {
    async onDeleteCommentSubmit(indexComment) {
      const commentId = this.comments[indexComment].id;
   
      const data = await send('../app/delete-comment.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json;charset=utf-8'
        },
        body: JSON.stringify({ 'id': commentId })
      });

      if (!data['result']) {
        alert('Не удалось удалить комментарий');
      } else {
        this.comments.splice(indexComment, 1);
      }
    },

    async onAddCommentSubmit() {

      if (validateForm.call(this)) {
        return;
      }
      
      const comment = {
        userName: this.formAddComment.userName,
        text: this.formAddComment.text,
        date: getLocalDateISOFormatted()
      };

      const data = await send('../app/create-comment.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json;charset=utf-8'
        },
        body: JSON.stringify(comment)
      });


      if (data['id']) {
        comment['id'] = data['id'];
        this.comments.unshift(comment);

        clearFormAddComment.call(this);
      }
      else {
        alert('Не удалось отправить данные :(');
      }
    },
    
    async onGetAllComments() {
      const data = await send('../app/get-all-coments.php');
      
      this.comments.splice(0, this.comments.length);
  
      const comments = JSON.parse(data['comments']);
  
      comments.forEach(comment => {
        this.comments.push(comment);
      });

      return this.comments;
    }
  },

  beforeMount(){
    this.onGetAllComments()
 }
}

Vue.createApp(App).mount('#app');