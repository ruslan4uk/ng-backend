import ArticleMain from '../ArticleMain.vue'
import ArticleShow from '../ArticleShow.vue'

export default [
  {
    path: '/article',
    name: 'article',
    component: ArticleMain,
    title: 'Список статей',
  },
  {
    path: '/article/:id',
    name: 'article-show',
    component: ArticleShow,
    title: 'Просмотр статьи',
  }
];