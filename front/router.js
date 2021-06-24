import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

export default new Router({
  mode: 'hash',
  base: process.env.BASE_URL,
  routes: [
    {
      path: '/',
      component: () => import('@/views/dashboard/Index'),
      children: [
        // Dashboard
        {
          name: 'Dashboard',
          path: '',
          component: () => import('@/views/dashboard/Dashboard'),
        },
        // Package
        // {
        //   name: 'Package',
        //   path: 'package',
        //   component: () => import('@/views/dashboard/pages/report/Package'),
        // },
        // Manual
        {
          name: 'Список пород',
          path: 'manual/species',
          component: () => import('@/views/dashboard/pages/manual/Species'),
        },        
        {
          name: 'Люди',
          path: 'manual/people',
          component: () => import('@/views/dashboard/pages/manual/People'),
        },        
        {
          name: 'Поставщики',
          path: 'manual/provider',
          component: () => import('@/views/dashboard/pages/manual/Provider'),
        },        
        {
          name: 'Качества брёвен',
          path: 'manual/timberquality',
          component: () => import('@/views/dashboard/pages/manual/TimberQuality'),
        },        
        {
          name: 'Штабеля',
          path: 'manual/stack',
          component: () => import('@/views/dashboard/pages/manual/Stack'),
        },        
        {
          name: 'Рабочее расписание',
          path: 'manual/workschedule',
          component: () => import('@/views/dashboard/pages/manual/WorkSchedule'),
        },  
        {
          name: 'Простои',
          path: 'manual/downtime',
          component: () => import('@/views/dashboard/pages/manual/Downtime'),
        },        
        {
          name: 'Ошибки',
          path: 'manual/error',
          component: () => import('@/views/dashboard/pages/manual/Error'),
        },        
        {
          name: 'Действия оператора',
          path: 'manual/action',
          component: () => import('@/views/dashboard/pages/manual/Action'),
        },       
        {
          name: 'Стандартные длины',
          path: 'manual/standartlength',
          component: () => import('@/views/dashboard/pages/manual/StandartLength'),
        },   
        //reports 
        {
          name: 'Хронология брёвен ',
          path: 'report/timberregistry',
          component: () => import('@/views/dashboard/pages/report/timber/Registry'),
        },        
        {
          name: 'Бревна',
          path: 'report/timber',
          component: () => import('@/views/dashboard/pages/report/timber/Timber'),
        },        
        {
          name: 'Простои ',
          path: 'report/downtimes',
          component: () => import('@/views/dashboard/pages/report/Downtime'),
        },        
        {
          name: 'Аварии и сообщения',
          path: 'report/alert',
          component: () => import('@/views/dashboard/pages/report/event/Alert'),
        },        
        {
          name: 'Действия оператора ',
          path: 'report/action',
          component: () => import('@/views/dashboard/pages/report/event/Action'),
        },          
      ],
    },
  ],
})
