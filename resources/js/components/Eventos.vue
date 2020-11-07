<template>

  <v-app>
    <v-card
     color="grey lighten-4"
    flat
    tile app>
    <v-toolbar color="red" dense app>
      <v-app-bar-nav-icon @click="estadoMenu =!estadoMenu"></v-app-bar-nav-icon>


    <v-spacer></v-spacer>

  </v-toolbar>
    </v-card>

<!--Menu vertical-->
<v-navigation-drawer    v-model="estadoMenu"  temporary dark app>

    <v-layout mt-4 column align-center>
      <v-flex>
        <v-avatar>
          <img src="https://randomuser.me/api/portraits/men/78.jpg">
        </v-avatar>
      </v-flex>
      <v-flex>
        <p class="white--text mt-3 headline">Nombre usuario</p>
      </v-flex>
    </v-layout>
      <v-divider></v-divider>

      <v-list>
        <v-list-item
        v-for="item in Paginas"
        :key="item.titulo"
        link
        :to="item.nombre"
        >
        <v-list-item-icon>
          <v-icon>{{item.icon}}</v-icon>
        </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title>{{ item.titulo }}</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>

      <v-divider></v-divider>

       <v-list>

        <v-list-item>
        <v-list-item-icon>
          <v-icon>mdi-settings</v-icon>
        </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title>Ajustes</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

  <v-list-item link href="/salir" color="error">

          <v-btn color="error" block ><v-icon>mdi-login</v-icon>Salir</v-btn>

        </v-list-item>

      </v-list>
</v-navigation-drawer>



  <v-content>
<router-view></router-view>
  </v-content>



  </v-app>

</template>

<script>



export default {
  name: 'App',

  components: {

  },

  data() {
    return{
        estadoMenu:false,

        Paginas:[
          {nombre:'Home',icon:'mdi-home',titulo:'Agregar evento'},

        ]

    }
  },

};
</script>
