import ArticleIndex from '../ArticleIndex.vue'
import ArticleUpdate from '../ArticleUpdate.vue'

export default [
  {
    path: '/article',
    name: 'article',
    component: ArticleIndex,
    meta: {
      title: 'Список статей',
    }
  },
  {
    path: '/article/:id',
    name: 'article-show',
    component: ArticleUpdate,
    meta: {
      title: 'Просмотр статьи',
    }
  },
  {
    path: '/article/create',
    name: 'article-create',
    component: ArticleUpdate,
    meta: {
      title: 'Добавить статью',
    }
  }
];