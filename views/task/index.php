<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\helpers\Url;

$this->title = 'Задачи';
?>
<div id="app">
    <task-nav></task-nav>
    <task-view>
        <task-sidebar></task-sidebar>
        <task-content></task-content>
    </task-view>
    <task-create-form></task-create-form>
    <todo-item v-for="todo in todos"
                   v-bind:todo="todo"
                   v-bind:key="todo.id">
    </todo-item>
</div>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script type="text/javascript">
    Vue.component('task-nav', {});
    Vue.component('task-sidebar', {});
    Vue.component('task-content', {});
    Vue.component('task-view', {});
    Vue.component('task-create-form',{
        template : '<form><input type=\'text\' name=\'title\' placeholder=\'Наименование todo\'/></form>'
    });
    Vue.component('todo-item', {
        props : ['todo'],
        template : '<div><h3>{{ todo.title }} {{ todo.start_date }}</h3><p>{{ todo.description }}</p></div>'
    });
    var app = new Vue({
        el : '#app',
        data : {
            todos : []
        }
    });

    axios.get('<?= Url::toRoute('/task/listtasks') ?>').then(function(response){
        app.todos = response.data.tasks;
    }).catch(function(error){ alert('Ошибка произошла, сударь');})
        .then(function() { console.log('ну, типа, отработало.') });
</script>