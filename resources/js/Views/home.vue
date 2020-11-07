<template>
    <v-container class="justify-center" >
        <h3> Eventos </h3>
         <v-btn @click="StateNuevo=!StateNuevo" color="primary" fab >
             <v-icon>
                 mdi-plus
             </v-icon>
         </v-btn>
          <v-simple-table>
              <thead>
                  <th>Id Restaurante</th> <th>Nombre Del evento</th> <th>Fecha</th>  <th>Acciones</th>
              </thead>
              <tbody>
                  <tr v-for="(item,index) in Eventos" :key="index">
                      <td>{{item.idRestaurante}}</td>
                      <td>{{item.NombreEvento}}</td>
                      <td>{{item.Fecha}}</td>
                      <td>{{item.IdCarnet}}</td>
                      <td> <button class="btn btn-warning btn-sm"
                @click="abrirEditar(index)"><v-icon>mdi-pencil</v-icon>   Editar</button>
            <button class="btn btn-danger btn-sm"
                @click="eliminar(index)"><v-icon>mdi-delete</v-icon>Eliminar</button>
                    <button class="blue btn-sm"
                @click="abrirDemo(index)"><v-icon>mdi-pencil-outline</v-icon></button>
                </td>
                  </tr>
              </tbody>
          </v-simple-table>

<!-- Agregar --->

<v-dialog v-model="StateNuevo" persistent max-width="700px">
    <v-card  class="justify-center">
         <form  enctype="multipart/form-data" @submit.prevent="agregar" lazy-validation >
        <v-card-title>Agregar Evento</v-card-title>

        <v-card-text>
            <v-container>
                <v-row>
                    <v-col cols="12">
                         <v-text-field
                         v-model="Evento.NombreEvento"
                label="Nombre de evento"
                append-icon="mdi-close"
                prepend-icon="mdi-account-circle-outline"
                :rules="nameRules"
                required
                ></v-text-field>

                    </v-col>
                    <v-col cols="12">
                        <v-text-field
                          v-model="Evento.Descripcion"
                label="Descripcion"
                append-icon="mdi-close"
                prepend-icon="mdi-book-open-outline"
                :rules="nameRules"
                required
                ></v-text-field>
                    </v-col>
                    <v-col cols="12">
                        <v-select
                        v-model="Evento.IdRestaurante"
                        :items="itemsSelect"
                        item-text="Nombre"
                        item-value="id"
                        label="restaurante"
                        required
                        >

                        </v-select>

                    </v-col>


                <v-col cols="12">

                 <v-file-input
                 accept="image/*"
    label="File input"
    filled
    prepend-icon="mdi-camera"
v-model="File"
required
  ></v-file-input>
                    </v-col>

                     <v-col cols="12">
                    <v-date-picker
                    v-model="date"
                    color="blue lighten-1"
                    ></v-date-picker>
                </v-col>



                </v-row>


            </v-container>
        </v-card-text>

        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="red darken-1"     @click="StateNuevo = false"  >
            Close
          </v-btn>
           <v-btn  color="blue darken-1" type="submit" >
            Save
          </v-btn>
        </v-card-actions>

            </form>

    </v-card>

</v-dialog>


<!-- Editar --->
<v-dialog v-model="StateNuevo" persistent max-width="700px" >

</v-dialog>

<v-dialog v-model="StateEditar" persistent max-width="700px">
    <v-card  class="justify-center">
         <form  enctype="multipart/form-data" @submit.prevent="Guardar(Evento)" lazy-validation  method="PUT">
        <v-card-title>Editar Evento</v-card-title>

        <v-card-text>
            <v-container>
                <v-row>
                    <v-col cols="12">
                         <v-text-field
                         v-model="Evento.NombreEvento"
                label="Nombre de evento"
                append-icon="mdi-close"
                prepend-icon="mdi-account-circle-outline"
                :rules="nameRules"
                required
                ></v-text-field>

                    </v-col>
                    <v-col cols="12">
                        <v-text-field
                          v-model="Evento.Descripcion"
                label="Descripcion"
                append-icon="mdi-close"
                prepend-icon="mdi-book-open-outline"
                :rules="nameRules"
                required
                ></v-text-field>
                    </v-col>
                    <v-col cols="12">
                        <v-select
                        v-model="Evento.IdRestaurante"
                        :items="itemsSelect"
                        item-text="Nombre"
                        item-value="id"
                        label="restaurante"
                        required
                        >

                        </v-select>

                    </v-col>



                     <v-col cols="12">
                    <v-date-picker
                    v-model="date"
                    color="blue lighten-1"
                    ></v-date-picker>
                </v-col>



                </v-row>


            </v-container>
        </v-card-text>

        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="red darken-1"     @click="cancelar"  >
            Cancelar
          </v-btn>
           <v-btn  color="blue darken-1" type="submit" >
            Save
          </v-btn>
        </v-card-actions>

            </form>

    </v-card>

</v-dialog>

<!-- Ver demo --->
<v-dialog v-model="StateDemo"  persistent max-width="700px" >
<v-card  class="justify-center">
  <v-img
      class="white--text align-end"
      height="200px"
      src="https://cdn.vuetifyjs.com/images/cards/docks.jpg"
    >
    <v-card-title>Top 10 Australian beaches</v-card-title>
  </v-img>
  <v-card-subtitle class="pb-0">
      Number 10
    </v-card-subtitle>
    <v-card-text class="text--primary">
      <div>Whitehaven Beach</div>

      <div>Whitsunday Island, Whitsunday Islands</div>
    </v-card-text>

      <v-card-actions>


           <v-btn  color="blue darken-1" type="submit" >
            Cerrar
          </v-btn>

    </v-card-actions>
</v-card>

</v-dialog>


    </v-container>
</template>

<script>
export default {
    created() {
       axios.get('/Homeo').then(res=>{
            this.Eventos=res.data;
        })
    },

    data() {
        return {
            Eventos:[],
            EventoEditar:[],
            EventoDemo:[],
            idEditar:{id:0 ,index:0},
            File:[],
            FileEditar:[],
            date:new Date().toISOString().substr(0, 10),
            Evento:{NombreEvento:'',Fecha:'',Imagen:[],Descripcion:'',IdRestaurante:1},
            EventoDemo:[],
            StateNuevo:false,
            StateEditar:false,
            StateDemo:false,
            itemsSelect:[
                {id:1,Nombre:'leyo'},
                {id:2,Nombre:'Sopa Rica'},
                {id:3,Nombre:'Sopa dormida'},
            ],
             nameRules: [
             v => !!v || 'El campo es requerido',
             v => (v && v.length >= 10) || 'Tienes que poner mas de 10 caracteres',
             ],



        }
    },
    methods: {
        getImage(event){
                //Asignamos la imagen a  nuestra data
                this.File = event.target.files[0];
                console.log(this.File);
            },
        agregar(){
        const NuevoEvento=this.Evento;
        NuevoEvento.Fecha=this.date;

        NuevoEvento.Imagen=this.File;
         console.log(NuevoEvento.Imagen);
        this.Evento={NombreEvento:'',Fecha:'',Imagen:{},Descripcion:'',IdRestaurante:''}
        var data=new FormData();
        data.append('NombreEvento',NuevoEvento.NombreEvento);
        data.append('Fecha',NuevoEvento.Fecha);
        data.append('Imagen',this.File);
        data.append('Descripcion',NuevoEvento.Descripcion);
        data.append('IdRestaurante',NuevoEvento.IdRestaurante);
         axios.post('/Home/Create', data, {headers: { 'Content-Type': 'multipart/form-data'}}).then((res) =>{
           const notaServidor = res;
            console.log(notaServidor);
            axios.get('/Homeo').then(res=>{
            this.Eventos=res.data;
        })

         });
         this.StateNuevo=false;
        },
         eliminar(index){
        const confirmacion = confirm(`Eliminar Evento ${this.Eventos[index].NombreEvento} ?`);
           if(confirmacion){
                console.log(this.Eventos[index].id);
               axios.delete(`/Home/eliminar/${this.Eventos[index].id}`).then(()=>{
                   this.Eventos.splice(index,1);
               })
           }
         },
         abrirEditar(index){
             this.idEditar.id=this.Eventos[index].id;
             console.log(this.idEditar.id);
            this.idEditar.index=index;
             this.StateEditar=true;
             this.EventoDemo.NombreEvento=this.Eventos[index].NombreEvento;
             this.EventoDemo.Fecha=this.Eventos[index].Fecha;
             this.EventoDemo.Descripcion=this.Eventos[index].Descripcion;
             this.EventoDemo.IdRestaurante=this.Eventos[index].IdRestaurante;
         },
         cancelar(){
            this.Evento={NombreEvento:'',Fecha:'',Imagen:{},Descripcion:'',IdRestaurante:''}
           this.StateEditar=false;
         },

         Guardar(EventoGuardar){

        EventoGuardar.Fecha=this.date;

        EventoGuardar.Imagen=this.FileEditar;


        const param={NombreEvento:EventoGuardar.NombreEvento,
        Fecha:EventoGuardar.Fecha,

        Descripcion:EventoGuardar.Descripcion,
        idRestaurante:EventoGuardar.IdRestaurante}
            axios.put(`/Home/Editar/${this.idEditar.id}`,param).then(
             res=>{
               this.StateEditar=false;
                axios.get('/Homeo').then(res=>{
            this.Eventos=res.data;
        })

                console.log(res.data);
             })



         },
         abrirDemo(index){
                      this.idEditar.id=this.Eventos[index].id;
             console.log(this.idEditar.id);
            this.idEditar.index=index;
             this.StateDemo=true;
             this.Evento.NombreEvento=this.Eventos[index].NombreEvento;
             this.Evento.Fecha=this.Eventos[index].Fecha;
             this.Evento.Descripcion=this.Eventos[index].Descripcion;
             this.Evento.IdRestaurante=this.Eventos[index].IdRestaurante;
         }

    }


}
</script>
