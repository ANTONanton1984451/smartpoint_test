let form=$("#to-ajax"),
    btn=$("#enter"),
    wrapper=$("#wrapper");
  $(document).ready(function () {
      btn.click(function (e) {
          e.preventDefault();
          $.ajax({
             url:'/index.php',
             type: "POST",
             dataType:"html",
             data:form.serialize(),
             success:function (response) {
                  let result=JSON.parse(response);
                  formAnswer(result);

             },
             error:function () {
                 alert("Ошибка при выполнении операции,попробуйте снова");
             }
          })
      })
  });

  function formAnswer(obj){
      switch (obj.user) {
          case 'no-auth':
              alert('Неверный логин или пароль');
              break;
          case 'success':
           form.remove();
           hellodiv=$(".hello");
           hellodiv.html('Здравствуйте, '+'<span>'+obj.name+'</span>'+' .Желаете перейти в '+'<a href="/lk.php">Личный кабинет?</a>');
           hellodiv.css('display','block');
      }
  }