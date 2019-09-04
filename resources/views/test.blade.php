<!DOCTYPE html>
<html>
<head>
  <title>My first Vue app</title>
  <script src="https://unpkg.com/vue"></script>
  <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
</head>
<body>
    <div id="components-demo">
        <button-counter></button-counter>
    </div>
  <script>
      Vue.component('button-counter', {
        data: function () {
          return {
            count: 0
          }
        },
        template: '<button v-on:click="count++">Bạn đã bấm @{{ count }} lần.</button>'
      })
      new Vue({ el: '#components-demo' })
  </script>
</body>
</html>