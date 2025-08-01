import {
  CircleIcon,
  WindmillIcon,
  TypographyIcon,
  ShadowIcon,
  PaletteIcon,
  KeyIcon,
  BugIcon,
  DashboardIcon,
  BrandChromeIcon,
  HelpIcon
} from 'vue-tabler-icons';

export interface menu {
  header?: string;
  title?: string;
  icon?: object;
  to?: string;
  divider?: boolean;
  chip?: string;
  chipColor?: string;
  chipVariant?: string;
  chipIcon?: string;
  children?: menu[];
  disabled?: boolean;
  type?: string;
  subCaption?: string;
}

const sidebarItem: menu[] = [
  { header: 'Dashboard' },
  {
    title: 'Default',
    icon: DashboardIcon,
    to: '/dashboard/default'
  },
  {
    title: 'Stock Level Report',
    icon: PaletteIcon,
    to: '/report/stock'
  },
  { divider: true },
  
  { header: 'Master Data' },
  {
    title: 'Master Data',
    icon: DashboardIcon,
    to: '/masterdata'
  },
  {
    title: 'Data Customer',
    icon: DashboardIcon,
    to: '/datacustomer'
  },
  {
    title: 'Data Machine',
    icon: DashboardIcon,
    to: '/datamachine'
  },
  { divider: true },

  { header: 'Production Control' },
  {
    title: 'Planning Production',
    icon: DashboardIcon,
    to: '/planningproduction'
  },
  {
    title: 'Monitoring Production',
    icon: DashboardIcon,
    to: '/monitoringproduction'
  },
  {
    title: 'Monitoring Production AG',
    icon: DashboardIcon,
    to: '/monitoringproductionag'
  },

  { divider: true },
  
  { header: 'Production' },
  {
    title: 'Daily Production',
    icon: DashboardIcon,
    to: '/dailyproduction'
  },
  {
    title: 'Production Result',
    icon: DashboardIcon,
    to: '/productionresult'
  },

  { divider: true },
  { header: 'Pages' },
  {
    title: 'Authentication',
    icon: KeyIcon,
    to: '/auth',
    children: [
      {
        title: 'Login',
        icon: CircleIcon,
        to: '/login1'
      },
      {
        title: 'Register',
        icon: CircleIcon,
        to: '/register'
      }
    ]
  },
  {
    title: 'Error 404',
    icon: BugIcon,
    to: '/error'
  },
  { divider: true },
  { header: 'Utilities' },
  {
    title: 'Typography',
    icon: TypographyIcon,
    to: '/utils/typography'
  },
  {
    title: 'Shadows',
    icon: ShadowIcon,
    to: '/utils/shadows'
  },
  {
    title: 'Colors',
    icon: PaletteIcon,
    to: '/utils/colors'
  },

  {
    title: 'Icons',
    icon: WindmillIcon,
    to: '/forms/radio',
    children: [
      {
        title: 'Tabler Icons',
        icon: CircleIcon,
        to: '/icons/tabler'
      },
      {
        title: 'Material Icons',
        icon: CircleIcon,
        to: '/icons/material'
      }
    ]
  },
  { divider: true },
  {
    title: 'Sample Page',
    icon: BrandChromeIcon,
    to: '/starter'
  },
  {
    title: 'Documentation',
    icon: HelpIcon,
    to: 'https://codedthemes.gitbook.io/berry-vuetify/',
    type: 'external'
  }
];

export default sidebarItem;
