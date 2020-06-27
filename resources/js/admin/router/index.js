import Vue from 'vue'
import Router from 'vue-router'

import Test from '../views/Test'

import Countries from '../views/countries/Index'
import CreateCountry from '../views/countries/Create'
import EditCountry from '../views/countries/Edit'

import Provinces from '../views/provinces/Index'
import CreateProvince from '../views/provinces/Create'
import EditProvince from '../views/provinces/Edit'

import Cities from '../views/cities/Index'
import CreateCity from '../views/cities/Create'
import EditCity from '../views/cities/Edit'

import Branches from '../views/branches/Index'
import CreateBranch from '../views/branches/Create'
import EditBranch from '../views/branches/Edit'

import Creditors from '../views/creditors/Index'
import CreateCreditor from '../views/creditors/Create'
import EditCreditor from '../views/creditors/Edit'

import Debtors from '../views/debtors/Index'
import CreateDebtor from '../views/debtors/Create'
import EditDebtor from '../views/debtors/Edit'

import Locations from '../views/locations/Index'
import CreateLocation from '../views/locations/Create'
import EditLocation from '../views/locations/Edit'


import ItemCategories from '../views/item_categories/Index'
import CreateItemCategory from '../views/item_categories/Create'
import EditItemCategory from '../views/item_categories/Edit'

import ItemGroups from '../views/item_groups/Index'
import CreateItemGroup from '../views/item_groups/Create'
import EditItemGroup from '../views/item_groups/Edit'

import ItemUnits from '../views/item_units/Index'
import CreateItemUnit from '../views/item_units/Create'
import EditItemUnit from '../views/item_units/Edit'

import Currencies from '../views/currencies/Index'
import CreateCurrency from '../views/currencies/Create'
import EditCurrency from '../views/currencies/Edit'

import Items from '../views/items/Index'
import CreateItem from '../views/items/Create'
import EditItem from '../views/items/Edit'

import ItemPrices from '../views/item_prices/Index'
import CreateItemPrice from '../views/item_prices/Create'
import EditItemPrice from '../views/item_prices/Edit'

import PurchaseOrders from '../views/purchase_orders/Index'
import CreatePurchaseOrder from '../views/purchase_orders/Create'
import EditPurchaseOrder from '../views/purchase_orders/Edit'

Vue.use(Router)

export default new Router({
    mode           : 'history',
    linkActiveClass: 'open active',
    scrollBehavior : () => ({ y: 0 }),
    routes         : [
      {
        path     : '/',
        redirect : '/dashboard',
        name     : 'home',
        component: Test,
        children : [
          {
            path     : 'dashboard',
            name     : 'dashboard',
            component: Test,
          },
        ],
    },
    {
      path     : '/countries',
      name     : 'countries',
      component: Countries,
    },
    {
      path     : '/countries/create',
      name     : 'create-country',
      component: CreateCountry,
    },
    {
      path: '/countries/:id/edit',
      name: 'edit-country',
      component: EditCountry
    },
    {
      path     : '/provinces',
      name     : 'provinces',
      component: Provinces,
    },
    {
      path     : '/provinces/create',
      name     : 'create-province',
      component: CreateProvince,
    },
    {
      path: '/provinces/:id/edit',
      name: 'edit-province',
      component: EditProvince
    },
    {
      path     : '/cities',
      name     : 'cities',
      component: Cities,
    },
    {
      path     : '/cities/create',
      name     : 'create-city',
      component: CreateCity,
    },
    {
      path: '/cities/:id/edit',
      name: 'edit-city',
      component: EditCity
    },
    {
      path     : '/branches',
      name     : 'branches',
      component: Branches,
    },
    {
      path     : '/branches/create',
      name     : 'create-branch',
      component: CreateBranch,
    },
    {
      path: '/branches/:id/edit',
      name: 'edit-branch',
      component: EditBranch
    },
    {
      path     : '/creditors',
      name     : 'creditors',
      component: Creditors,
    },
    {
      path     : '/creditors/create',
      name     : 'create-creditor',
      component: CreateCreditor,
    },
    {
      path: '/creditors/:id/edit',
      name: 'edit-creditor',
      component: EditCreditor
    },
    {
      path     : '/debtors',
      name     : 'debtors',
      component: Debtors,
    },
    {
      path     : '/debtors/create',
      name     : 'create-debtor',
      component: CreateDebtor,
    },
    {
      path: '/debtors/:id/edit',
      name: 'edit-debtor',
      component: EditDebtor
    },
    {
      path     : '/locations',
      name     : 'locations',
      component: Locations,
    },
    {
      path     : '/locations/create',
      name     : 'create-location',
      component: CreateLocation,
    },
    {
      path: '/locations/:id/edit',
      name: 'edit-location',
      component: EditLocation
    },
    {
      path     : '/item-categories',
      name     : 'item-categories',
      component: ItemCategories,
    },
    {
      path     : '/item-categories/create',
      name     : 'create-item-category',
      component: CreateItemCategory,
    },
    {
      path: '/item-categories/:id/edit',
      name: 'edit-item-category',
      component: EditItemCategory
    },
    {
      path     : '/item-groups',
      name     : 'item-groups',
      component: ItemGroups,
    },
    {
      path     : '/item-groups/create',
      name     : 'create-item-group',
      component: CreateItemGroup,
    },
    {
      path: '/item-groups/:id/edit',
      name: 'edit-item-group',
      component: EditItemGroup
    },
    {
      path     : '/item-units',
      name     : 'item-units',
      component: ItemUnits,
    },
    {
      path     : '/item-units/create',
      name     : 'create-item-unit',
      component: CreateItemUnit,
    },
    {
      path: '/item-units/:id/edit',
      name: 'edit-item-unit',
      component: EditItemUnit
    },
    {
      path     : '/currencies',
      name     : 'currencies',
      component: Currencies,
    },
    {
      path     : '/currencies/create',
      name     : 'create-currency',
      component: CreateCurrency,
    },
    {
      path: '/currencies/:id/edit',
      name: 'edit-currency',
      component: EditCurrency
    },
    {
      path     : '/items',
      name     : 'items',
      component: Items,
    },
    {
      path     : '/items/create',
      name     : 'create-item',
      component: CreateItem,
    },
    {
      path: '/items/:id/edit',
      name: 'edit-item',
      component: EditItem
    },
    {
      path     : '/item-prices',
      name     : 'item-prices',
      component: ItemPrices,
    },
    {
      path     : '/item-prices/create',
      name     : 'create-item-price',
      component: CreateItemPrice,
    },
    {
      path: '/item-prices/:id/edit',
      name: 'edit-item-price',
      component: EditItemPrice
    },
    {
      path     : '/purchase-orders',
      name     : 'purchase-orders',
      component: PurchaseOrders,
    },
    {
      path     : '/purchase-orders/create',
      name     : 'create-purchase-order',
      component: CreatePurchaseOrder,
    },
    {
      path: '/purchase-orders/:id/edit',
      name: 'edit-purchase-order',
      component: EditPurchaseOrder
    }
  ]});