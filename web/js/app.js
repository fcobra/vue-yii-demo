(function ($) {

    /**
     * Компонента списка новостей
     */
    const NewsList = Vue.component('news-list', {
        data: function () {
            return {}
        },
        template: '<div class=""><div class=" text-right"><router-link :to="{name: \'create\'}" class="btn btn-success btn-xs">Добавить</router-link></div><div class="row"><div class="col-lg-4" v-for="item in this.$parent.news_list">\n' +
            '                <h2>{{ item.title }}</h2>\n' +
            '                <p>{{ item.text_short }}</p>\n' +
            '                <p><router-link class="btn btn-default" :to="{name: \'news\', params: {id: item.id}}">Подробнее &raquo;</router-link></p>\n' +
            '            </div></div></div>'
    });

    /**
     * Компонента просмотра новости
     * @type {{data(): *, mounted(): void, template: string}}
     */
    const NewsView = {
        data(){
            return {
                record: {},
                unloaded: true
            }
        },
        mounted(){
            let me = this;
            axios . get('/api/news/load?id=' + this.$parent._route.params.id)
                .then( function (response) { me.record = response.data; me.unloaded = false;} );
        },
        template: '<div><router-link :to="{name: \'main\'}">Все новости</router-link>' +
            '<div v-if="unloaded">Загружается...</div>' +
            '<h1>{{ record.title }}</h1>' +
            '<small class="help">{{ record.date }}</small> {{ this.$parent.author_list[record.id].label }}' +
            '<div class="col-lg-12">{{ record.text }}</div>' +
            '</div>'
    };

    /**
     * Компонента добавления новости
     * @type {{template: string}}
     */
    const AddRecord = {
        data(){
            return {
                title: null,
                author_id: null,
                text: null,
            }
        },
        methods: {
            save: function () {
                let me = this,
                    title = me.title.trim(),
                    author_id = me.author_id,
                    text = me.text.trim()
                ;

                if(title.length && author_id && text.length){
                    // let data = JSON.stringify({title: title, author_id: author_id, text: text});
                    let data = {title: title, author_id: author_id, text: text};
                    axios.post('/api/news/create', data).then((response) => {
                        this.$parent.loadNews();
                        window.location.href = '/';
                    })
                } else {
                    alert('Необходимо зполнить все поля');
                }
            }
        },
        template: '<div><router-link :to="{name: \'main\'}">Все новости</router-link>' +
            '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">' +
            '<div class="form-group field-projects-address">' +
            '<label class="control-label" for="projects-address">Заголовок</label>' +
            '<input type="text" class="form-control" maxlength="255" autocomplete="off" v-model="title">' +
            '<p class="help-block help-block-error"></p>' +
            '</div></div>' +

            '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">' +
            '<select v-model="author_id" class="form-control"><option v-for="item in this.$parent.author_list" v-bind:value="item.id" >{{ item.label }}</option></select>' +
            '</div>' +

            '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">' +
            '<div class="form-group field-projects-address">' +
            '<label class="control-label" for="projects-address">Текст</label>' +
            '<textarea class="form-control" v-model="text"></textarea>' +
            '<p class="help-block help-block-error"></p>' +
            '</div></div>' +

            '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><button class="btn btn-success" v-on:click="save()">Сохранить</button></div>' +

            '</div>'
    };

    /**
     * Список обработчиков адресов
     * @type {*[]}
     */
    const routes = [
        {path: '/', component: NewsList, name: 'main'},
        {path: '/news/create', component: AddRecord, name: 'create'},
        {path: '/news/:id', component: NewsView, name: 'news'},
    ];

    /**
     * Компонента роутинга
     * @type {VueRouter}
     */
    const router = new VueRouter({
        routes // сокращённая запись для `routes: routes`
    });

    /**
     * Наша приложенька на VueJS
     */
    new Vue({
        router,
        data: {
            news_list: [
                // {id: 5, title: 'ttttt itle', text_short: 'text text short'},
                // {id: 5, title: 'ttttt itle', text_short: 'text text short'},
                // {id: 5, title: 'ttttt itle', text_short: 'text text short'},
                // {id: 5, title: 'ttttt itle', text_short: 'text text short'},
                // {id: 5, title: 'ttttt itle', text_short: 'text text short'},
            ],
            author_list: []
        },
        methods: {
            loadNews: function () {
                axios.get('/api/news', null).then((response) => {
                    this.news_list = response.data;
                });
            }
        },
        created: function () {
            let me = this;
            me.loadNews();
            axios.get('/api/authors', null).then((response) => {
                this.author_list = response.data;
            });
        }

    }).$mount('#vue_app');

}(jQuery));