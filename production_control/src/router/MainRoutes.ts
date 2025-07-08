const MainRoutes = {
  path: '/main',
  meta: {
    requiresAuth: true
  },
  redirect: '/main/dashboard/default',
  component: () => import('@/layouts/full/FullLayout.vue'),
  children: [
    {
      name: 'LandingPage',
      path: '/',
      component: () => import('@/views/dashboards/default/DefaultDashboard.vue')
    },
    {
      name: 'Default',
      path: '/dashboard/default',
      component: () => import('@/views/dashboards/default/DefaultDashboard.vue')
    },
    {
      name: 'Stock Report',
      path: '/report/stock',
      component: () => import('@/views/pages/report/StockLevelReport.vue')
    },
    {
      name: 'Master Data',
      path: '/masterdata',
      component: () => import('@/views/tables/MasterData.vue')
    },
    {
      name: 'Data Customer',
      path: '/datacustomer',
      component: () => import('@/views/tables/DataCustomer.vue')
    },
    {
      name: 'Data Machine',
      path: '/datamachine',
      component: () => import('@/views/tables/DataMachine.vue')
    },
    {
      name: 'Delivery Order',
      path: '/deliveryorder',
      component: () => import('@/views/pages/production_control/DeliveryOrder.vue')
    },
    {
      name: 'Planning Production',
      path: '/planningproduction',
      component: () => import('@/views/pages/production_control/ProductionPlanning.vue')
    },
    {
      name: 'Monitoring Production',
      path: '/monitoringproduction',
      component: () => import('@/views/pages/production_control/MonitoringProduction.vue')
    },
    {
      name: 'Monitoring Production AG-GRID',
      path: '/monitoringproductionag',
      component: () => import('@/views/pages/production_control/MonitoringProductionAg.vue')
    },
    {
      name: 'Daily Production',
      path: '/dailyproduction',
      component: () => import('@/views/pages/production/DailyProduction.vue')
    },
    {
      name: 'Production Result',
      path: '/productionresult',
      component: () => import('@/views/pages/production/ProductionResult.vue')
    },
    {
      name: 'Starter',
      path: '/starter',
      component: () => import('@/views/StarterPage.vue')
    },
    {
      name: 'Tabler Icons',
      path: '/icons/tabler',
      component: () => import('@/views/utilities/icons/TablerIcons.vue')
    },
    {
      name: 'Material Icons',
      path: '/icons/material',
      component: () => import('@/views/utilities/icons/MaterialIcons.vue')
    },
    {
      name: 'Typography',
      path: '/utils/typography',
      component: () => import('@/views/utilities/typography/TypographyPage.vue')
    },
    {
      name: 'Shadows',
      path: '/utils/shadows',
      component: () => import('@/views/utilities/shadows/ShadowPage.vue')
    },
    {
      name: 'Colors',
      path: '/utils/colors',
      component: () => import('@/views/utilities/colors/ColorPage.vue')
    }
  ]
};

export default MainRoutes;
