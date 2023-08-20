import './bootstrap';
import {createApp} from "vue";
import customerDashboard from './components/Customer/customerDashboard.vue'
import addProductDetails from './components/Admin/addProductDetails.vue'
createApp(customerDashboard).mount("#customerDashboard")
createApp(addProductDetails).mount("#addProductDetails")
