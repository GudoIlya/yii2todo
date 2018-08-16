<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\helpers\Url;

$this->title = 'Задачи';
?>
<div class="container">
    <span>Выполнить</span>
    <div class="row">

    </div>
</div>
<div class="container">
    <span>Выполнено</span>
    <div class="row">

    </div>
</div>
<ul>
    <?php foreach($tasks as $task): ?>
    <li>
        <?= Html::encode("{$task->title}"); ?> : <?= Html::encode("{$task->end_date}"); ?>
    </li>
    <?php endforeach; ?>
</ul>
<?= LinkPager::widget(['pagination' => $pagination]); ?>

<div id="app">
    <task-nav></task-nav>
    <task-view>
        <task-sidebar></task-sidebar>
        <task-content></task-content>
    </task-view>
    <ol>
        <todo-item v-for="todo in todos"
                   v-bind:todo="todo"
                   v-bind:key="todo.id">
        </todo-item>
    </ol>
</div>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script type="text/javascript">
    Vue.component('task-nav', {});
    Vue.component('task-view', {});
    Vue.component('task-sidebar', {});
    Vue.component('task-content', {});

    Vue.component('todo-item', {
        props : ['todo'],
        template : '<li>{{ todo.title }} - {{ todo.start_date }}</li>'
    });
    var app = new Vue({
        el : '#app',
        data : {
            todos : []
        }
    });

    axios.get('<?= Url::toRoute('/task/tasks') ?>').then(function(response){
        app4.todos = response.data.tasks;
    }).catch(function(error){ alert('Ошибка произошла, сударь');})
        .then(function() { console.log('ну, типа, отработало.') });
</script>