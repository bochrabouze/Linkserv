<template>
    <v-app id="inspire">
    <v-navigation-drawer
      v-model="drawer"
      :mini-variant="miniVariant"
      :clipped="clipped"
      fixed
      app
    >
      <v-list>
        <v-list-item
          v-for="(item, i) in items"
          :key="i"
          :to="item.to"
          color="red"
          router
          exact
         
          
        >
        
          <v-list-item-action>
            <v-icon>{{ item.icon }}</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title v-text="item.title" />
          </v-list-item-content>
        </v-list-item>
        <v-list-item
          @click="logout"
           router
          exact
        >
        
          <v-list-item-action>
            <v-icon>mdi-logout</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title  >Sortie</v-list-item-title  >
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>
    <v-app-bar
      :clipped-left="clipped"
      fixed
      app
    >
      <v-app-bar-nav-icon @click.stop="drawer = !drawer" />
      
     
      <router-link to="/home" ><v-icon>mdi-view-dashboard</v-icon></router-link>
       <v-toolbar-title style="font-size: 20px; color:white;border-radius: 16px; padding: 10px; margin:8px; background-color: #f44336; cursor: pointer;"  v-text="title" />
      
      <v-spacer />
      <v-btn
        icon
        @click.stop="rightDrawer = !rightDrawer"
      >
       
      </v-btn>
    </v-app-bar>
    <v-main>
            <v-container>
                <router-view></router-view>
            </v-container>
        </v-main>
    <v-navigation-drawer
      v-model="rightDrawer"
      :right="right"
      temporary
      fixed
    >
      <v-list>
        <v-list-item @click.native="right = !right">
          <v-list-item-action>
            <v-icon light>
              mdi-repeat
            </v-icon>
          </v-list-item-action>
          <v-list-item-title>Switch drawer (click me)</v-list-item-title>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>
    <v-footer
      :absolute="!fixed"
      app
    >
      <span>&copy; {{ new Date().getFullYear() }} <a style="color:#ef6223" href="https://youinsoft.com"><b>Youinsoft</b></a></span>
    </v-footer>
    </v-app>
</template>

<script>
    export default {
      
       data () {
    return {
      clipped: false,
      drawer: false,
       isLoggedIn: false,
       user:"",
      fixed: false,
      items: [
        // {
        //   icon: 'mdi-seal-variant',
        //   title: 'Permis',
        //   to: '/permis'
        // },
         {
          icon: 'mdi-shield-star-outline',
          title: 'Forfait',
          to: '/forfait'
        },

        {
          icon: 'mdi-shield-star-outline',
          title: 'Application',
          to: '/application'
        },

        {
          icon: 'mdi-shield-star-outline',
          title: 'Profileapplicant',
          to: '/profileapplicant'
        },

         {
          icon: 'mdi-shield-star-outline',
          title: 'Profileservant',
          to: '/profileservant'
        },
         {
          icon: 'mdi-shield-star-outline',
          title: 'Applicant',
          to: '/applicant'
        },

         {
          icon: 'mdi-shield-star-outline',
          title: 'Servant',
          to: '/servant'
        },

         {
          icon: 'mdi-shield-star-outline',
          title: 'Service',
          to: '/service'
        },

         {
          icon: 'mdi-shield-star-outline',
          title: 'Applicationapplicant',
          to: '/applicationapplicant'
        },
        

       
        {
          icon: 'mdi-shield-star-outline',
          title: 'Detailapplication',
          to: '/detailapplication'
        },

        {
          icon: 'mdi-shield-star-outline',
          title: 'Detailservice',
          to: '/detailservice'
        },
      
          
        
      
      ],
      miniVariant: false,
      right: true,
      rightDrawer: false,
      title: 'Linkserv'
    }
  },
        created () {
            this.$vuetify.theme.dark = false
            // window.location.href = "/dashbord"
             if (window.Laravel.isLoggedin) {
            this.isLoggedIn = true
            this.user=window.Laravel.user
            console.log("login check")
            console.log(window.Laravel)


        }
        },

              methods: {
        

        logout(e) {
            console.log('ss')
            e.preventDefault()
            
                axios.post('/logout')
                    .then(response => {
                         console.log("logout")
                        if (response.data.success) {
                          this.$forceUpdate();
                          // window.location.reload()
                            window.location.href = "/"
                        } else {
                            // console.log(response)
                            window.location.href = "/"
                        }
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            
        }
        
    },
    mounted: function () {
  this.$nextTick(function () {
    // Code that will run only after the
    // entire view has been rendered
    // window.location.href = "/dashbord"
  })
}
    }
</script>