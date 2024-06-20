<?php

namespace Database\Seeders;

use App\Models\Config\Persona;
use App\Models\Empresa\Empleado;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class TablaUsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('personas')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');



        $usuario1 = User::create([
            'name' => 'Cesar Maya',
            'username' => 'adminsis',
            'email' => 'adminsis@gmail.com',
            'password' => bcrypt('adminsis')
        ])->syncRoles('Super Administrador');
        //------------------------------------------------------
        $usuario2 = User::create([
            'name' => 'Administrador',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin')
        ])->syncRoles(['Administrador']);
        //------------------------------------------------------
        //Jurados
        $jurados=[
            ['usuario' =>'jose.medina','password' =>'79611924', 'identificacion' => '79611924', 'nombre1' => 'José', 'nombre2' => 'Gregorio', 'apellido1' => 'Medina', 'apellido2' => 'Cepeda', 'telefono' => '3138872295','email' => 'jgmedina@unisalle.edu.co'],
            ['usuario' =>'ruben.diaz','password' =>'91455827', 'identificacion' => '91455827', 'nombre1' => 'Rubén', 'nombre2' => 'Darío', 'apellido1' => 'Díaz', 'apellido2' => 'Mateus', 'telefono' => '3003017403','email' => 'rudiaz@unisalle.edu.co'],
            ['usuario' =>'juan.bravo','password' =>'79054021', 'identificacion' => '79054021', 'nombre1' => 'Juan', 'nombre2' => 'Hernando', 'apellido1' => 'Bravo', 'apellido2' => 'Reyes', 'telefono' => '3143312813','email' => 'jbravo@unisalle.edu.co'],
            ['usuario' =>'omar.sierra','password' =>'79882924', 'identificacion' => '79882924', 'nombre1' => 'Omar', 'nombre2' => 'Andrés', 'apellido1' => 'Sierra', 'apellido2' => 'Morales', 'telefono' => '3102838947','email' => 'osierra@unisalle.edu.co'],
            ['usuario' =>'carlos.ortega','password' =>'1032383639', 'identificacion' => '1032383639', 'nombre1' => 'Carlos', 'nombre2' => 'Eduardo', 'apellido1' => 'Ortega', 'apellido2' => 'Peña', 'telefono' => '3043807945','email' => 'cortega@unisalle.edu.co'],
            ['usuario' =>'elena.infante','password' =>'52496625', 'identificacion' => '52496625', 'nombre1' => 'Elena Del Pilar', 'nombre2' => null, 'apellido1' => 'Infante', 'apellido2' => 'Sánchez', 'telefono' => '3012324449','email' => 'einfante@unisalle.edu.co'],
            ['usuario' =>'wilson.garcia','password' =>'93395675', 'identificacion' => '93395675', 'nombre1' => 'Wilson', 'nombre2' => 'Oviedo', 'apellido1' => 'García', 'apellido2' => null, 'telefono' => '3187556034','email' => 'woviedo@unisalle.edu.co'],
            ['usuario' =>'sander.rangel','password' =>'88157907', 'identificacion' => '88157907', 'nombre1' => 'Sander', 'nombre2' => 'Alberto', 'apellido1' => 'Rangel', 'apellido2' => 'Jiménez', 'telefono' => '3158057865','email' => 'sarangel@lasalle.edu.co'],
            ['usuario' =>'mauro.mendoza','password' =>'79189078', 'identificacion' => '79189078', 'nombre1' => 'Mauro', 'nombre2' => 'Fernando', 'apellido1' => 'Mendoza', 'apellido2' => null, 'telefono' => '3214248025','email' => 'maurofernandomendozaconsultor@gmail.com'],
            ['usuario' =>'luis.gil','password' =>'79848577', 'identificacion' => '79848577', 'nombre1' => 'Luis', 'nombre2' => 'Alejandro', 'apellido1' => 'Gil', 'apellido2' => 'Valbuena', 'telefono' => '3134617249','email' => 'emprendimiento@mosquera-cundinamarca.gov.co'],
            ['usuario' =>'josé.garzón','password' =>'1076621517', 'identificacion' => '1076621517', 'nombre1' => 'José', 'nombre2' => 'Fernando', 'apellido1' => 'Garzón', 'apellido2' => 'Morales', 'telefono' => '3017638951','email' => 'jfernando399@hotmail.com'],
            ['usuario' =>'diana.bohórquez','password' =>'1073152249', 'identificacion' => '1073152249', 'nombre1' => 'Diana', 'nombre2' => 'Patricia', 'apellido1' => 'Bohórquez', 'apellido2' => 'Saldaña', 'telefono' => '310 8610277','email' => 'diana.bohorquez@madridcundinamarca.gov.co '],
            ['usuario' =>'diana.carmona','password' =>'52824971', 'identificacion' => '52824971', 'nombre1' => 'Diana', 'nombre2' => 'Milena', 'apellido1' => 'Carmona', 'apellido2' => 'Muñoz', 'telefono' => '3183607156','email' => 'dmcarmona@lasalle.edu.co'],
            ['usuario' =>'javier.salcedo','password' =>'11434648', 'identificacion' => '11434648', 'nombre1' => 'Javier', 'nombre2' => 'Ricardo', 'apellido1' => 'Salcedo', 'apellido2' => 'Casallas', 'telefono' => '3156430917','email' => 'jsalcedo@unisalle.edu.co'],

        ];
        foreach ($jurados as $jurado) {
            $length = 10;
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';

            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[random_int(0, $charactersLength - 1)];
            }

            $user = User::create([
                'name' => $jurado['nombre1'].' '.$jurado['apellido1'],
                'username' => $jurado['usuario'],
                'email' => $jurado['email'],
                'password' => bcrypt($randomString),
            ])->syncRoles(['Jurado']);

            Persona::create([
                'id' => $user->id,
                'docutipos_id' => 1,
                'identificacion' => $jurado['identificacion'],
                'nombre1' => $jurado['nombre1'],
                'nombre2' => $jurado['nombre2'],
                'apellido1' => $jurado['apellido1'],
                'apellido2' => $jurado['apellido2'],
                'telefono' => $jurado['telefono'],
                'email' => $jurado['email'],
                'ups' => $randomString,

            ]);
        }
        //------------------------------------------------------
        $emprendedores = [
            ['usuario' => 'natalia.garzon', 'password' => '1073516926','id'=>'7','docutipos_id'=>1,'identificacion'=>'1073516926','nombre1'=>'Natalia','apellido1'=>'Garzon Betancourt','telefono'=>'3125317615','direccion'=>'mipeludoamigopetshop@gmail.com','email'=>'mipeludoamigopetshop@gmail.com',],
            ['usuario' => 'ronald.delgado', 'password' => '80214918','id'=>'8','docutipos_id'=>1,'identificacion'=>'80214918','nombre1'=>'Ronald Mauricio','apellido1'=>'Delgado García','telefono'=>'3157875878','direccion'=>'rmdg1984@gmail.com','email'=>'rmdg1984@gmail.com',],
            ['usuario' => 'sergio.callejas', 'password' => '79486130','id'=>'9','docutipos_id'=>1,'identificacion'=>'79486130','nombre1'=>'Sergio','apellido1'=>'Callejas Páramo','telefono'=>'3108584761','direccion'=>'gerenciatextifast@gmail.com','email'=>'gerenciatextifast@gmail.com',],
            ['usuario' => 'freddy.munoz', 'password' => '80655165','id'=>'10','docutipos_id'=>1,'identificacion'=>'80655165','nombre1'=>'Freddy Alejandro','apellido1'=>'Muñoz Munar','telefono'=>'3125001953','direccion'=>'fagoseyli@gmail.com','email'=>'fagoseyli@gmail.com',],
            ['usuario' => 'eliana.baiter', 'password' => '45767423','id'=>'11','docutipos_id'=>1,'identificacion'=>'45767423','nombre1'=>'Eliana Patricia','apellido1'=>'Baiter Montero','telefono'=>'3192210204','direccion'=>'elipa-28@hotmail.com','email'=>'elipa-28@hotmail.com',],
            ['usuario' => 'alison.guaqueta', 'password' => '1007703395','id'=>'12','docutipos_id'=>1,'identificacion'=>'1007703395','nombre1'=>'Alison Dayana','apellido1'=>'Guaqueta Zuluaga','telefono'=>'3102824233','direccion'=>'adgznana@gmail.com','email'=>'adgznana@gmail.com',],
            ['usuario' => 'karen.heredia', 'password' => '1073507447','id'=>'13','docutipos_id'=>1,'identificacion'=>'1073507447','nombre1'=>'Karen Alejandra','apellido1'=>'Heredia Sierra','telefono'=>'3002618961','direccion'=>'herediasalejandra@gmail.com','email'=>'herediasalejandra@gmail.com',],
            ['usuario' => 'ruth.villegas', 'password' => '1107102219','id'=>'14','docutipos_id'=>1,'identificacion'=>'1107102219','nombre1'=>'Ruth','apellido1'=>'Villegas Saavedra','telefono'=>'3168963599','direccion'=>'elmundocreativoa.r@gmail.com','email'=>'elmundocreativoa.r@gmail.com',],
            ['usuario' => 'sonia.laverde', 'password' => '52852155','id'=>'15','docutipos_id'=>1,'identificacion'=>'52852155','nombre1'=>'Sonia Constanza','apellido1'=>'Laverde Cañón','telefono'=>'3112632878','direccion'=>'crochetteando.bogota@gmail.com','email'=>'crochetteando.bogota@gmail.com',],
            ['usuario' => 'erika.umana', 'password' => '35525711','id'=>'16','docutipos_id'=>1,'identificacion'=>'35525711','nombre1'=>'Erika','apellido1'=>'Umaña Casallas','telefono'=>'3025162424','direccion'=>'erikauma2014@gmail.com','email'=>'erikauma2014@gmail.com',],
            ['usuario' => 'claudia.romero', 'password' => '52891095','id'=>'17','docutipos_id'=>1,'identificacion'=>'52891095','nombre1'=>'Claudia Patricia','apellido1'=>'Romero Garzon','telefono'=>'3185541563','direccion'=>'romeroclaudia10@hotmail.com','email'=>'romeroclaudia10@hotmail.com',],
            ['usuario' => 'virgilio.rativa', 'password' => '19467453','id'=>'18','docutipos_id'=>1,'identificacion'=>'19467453','nombre1'=>'Virgilio','apellido1'=>'Rativa Camargo','telefono'=>'3212192135','direccion'=>'brillocolor.v@gmail.com','email'=>'brillocolor.v@gmail.com',],
            ['usuario' => 'diana.pena', 'password' => '1073516031','id'=>'19','docutipos_id'=>1,'identificacion'=>'1073516031','nombre1'=>'Diana Lorena','apellido1'=>'Peña Ninco','telefono'=>'3505381028','direccion'=>'dianalorenpn@gmail.com','email'=>'dianalorenpn@gmail.com',],
            ['usuario' => 'gladys.mendoza', 'password' => '39736411','id'=>'20','docutipos_id'=>1,'identificacion'=>'39736411','nombre1'=>'Gladys','apellido1'=>'Mendoza Prieto','telefono'=>'3108075799','direccion'=>'mendozaprieto@hotmail.com','email'=>'mendozaprieto@hotmail.com',],
            ['usuario' => 'mariela.bello', 'password' => '35415635','id'=>'21','docutipos_id'=>1,'identificacion'=>'35415635','nombre1'=>'Mariela','apellido1'=>'Bello Barreto','telefono'=>'3167918305','direccion'=>'mariela.bello13@gmail.com','email'=>'mariela.bello13@gmail.com',],
            ['usuario' => 'johanna.ramirez', 'password' => '1073508936','id'=>'22','docutipos_id'=>1,'identificacion'=>'1073508936','nombre1'=>'Johanna Andrea','apellido1'=>'Ramirez Vergara','telefono'=>'3102051640','direccion'=>'johannisjar1@gmail.com','email'=>'johannisjar1@gmail.com',],
            ['usuario' => 'gilberto.parra', 'password' => '14961942','id'=>'23','docutipos_id'=>1,'identificacion'=>'14961942','nombre1'=>'Gilberto Antonio','apellido1'=>'Parra García','telefono'=>'3164887929','direccion'=>'gilberto.gilpar@gmail.com','email'=>'gilberto.gilpar@gmail.com',],
            ['usuario' => 'tania.vargas', 'password' => '28488668','id'=>'24','docutipos_id'=>1,'identificacion'=>'28488668','nombre1'=>'Tania','apellido1'=>'Vargas Vivas','telefono'=>'3203635646','direccion'=>'tvvnfj@hotmail.com','email'=>'tvvnfj@hotmail.com',],
            ['usuario' => 'dirley.laverde', 'password' => '52664146','id'=>'25','docutipos_id'=>1,'identificacion'=>'52664146','nombre1'=>'Dirley Andrea','apellido1'=>'Laverde Amaya','telefono'=>'3203233965','direccion'=>'dirleylaverde@gmail.com','email'=>'dirleylaverde@gmail.com',],
            ['usuario' => 'michael.guanume', 'password' => '1073245448','id'=>'26','docutipos_id'=>1,'identificacion'=>'1073245448','nombre1'=>'Michael David','apellido1'=>'Guanume Roberto','telefono'=>'3176987812','direccion'=>'dgfinanciero@gmail.com','email'=>'dgfinanciero@gmail.com',],
            ['usuario' => 'carlos.castillo', 'password' => '80072004','id'=>'27','docutipos_id'=>1,'identificacion'=>'80072004','nombre1'=>'Carlos Enrique','apellido1'=>'Castillo Torres','telefono'=>'3103060448','direccion'=>'castell007@gmail.com','email'=>'castell007@gmail.com',],
            ['usuario' => 'alejandro.aguja', 'password' => '1110176947','id'=>'28','docutipos_id'=>1,'identificacion'=>'1110176947asd','nombre1'=>'Alejandro','apellido1'=>'Aguja Leal','telefono'=>'3212047052','direccion'=>'alejo12xm@gmail.com','email'=>'alejo12xm@gmail.com',],
            ['usuario' => 'alida.lopez', 'password' => '41790002','id'=>'29','docutipos_id'=>1,'identificacion'=>'41790002','nombre1'=>'Alida','apellido1'=>'López Pérez','telefono'=>'3152729836','direccion'=>'alidalperez@gmail.com','email'=>'alidalperez@gmail.com',],
            ['usuario' => 'leidy.urbano', 'password' => '52664617','id'=>'30','docutipos_id'=>1,'identificacion'=>'52664617','nombre1'=>'Leidy Johanna','apellido1'=>'Urbano Cifuentes','telefono'=>'3216764107','direccion'=>'gerencia.urbanotex@gmail.com','email'=>'gerencia.urbanotex@gmail.com',],
            ['usuario' => 'estefania.sanchez', 'password' => '1073507466','id'=>'31','docutipos_id'=>1,'identificacion'=>'1073507466','nombre1'=>'Estefania','apellido1'=>'Sanchez Marin','telefono'=>'3043408582','direccion'=>'tefa8980@hotmail.com','email'=>'tefa8980@hotmail.com',],
            ['usuario' => 'claudia.cabra', 'password' => '1073380875','id'=>'33','docutipos_id'=>1,'identificacion'=>'1073380875','nombre1'=>'Claudia Cenaida','apellido1'=>'Cabra Guerrero','telefono'=>'3114662156','direccion'=>'erilogroup@gmail.com','email'=>'erilogroup@gmail.com',],
            ['usuario' => 'romulo.vargas', 'password' => '80148085','id'=>'34','docutipos_id'=>1,'identificacion'=>'80148085','nombre1'=>'Romulo Alexander','apellido1'=>'Vargas Sanabria','telefono'=>'3105209936','direccion'=>'alexvars2@gmail.com','email'=>'alexvars2@gmail.com',],
            ['usuario' => 'juan.rozo', 'password' => '1000049737','id'=>'35','docutipos_id'=>1,'identificacion'=>'1000049737','nombre1'=>'Juan David','apellido1'=>'Rozo Susatama','telefono'=>'3147678007','direccion'=>'rozoj1124@gmail.com','email'=>'rozoj1124@gmail.com',],
            ['usuario' => 'wigsthon.osorio', 'password' => '79904206','id'=>'36','docutipos_id'=>1,'identificacion'=>'79904206','nombre1'=>'Wigsthon Leonardo','apellido1'=>'Osorio Castañeda','telefono'=>'3027168611','direccion'=>'colsolutech@gmail.com','email'=>'colsolutech@gmail.com',],
            ['usuario' => 'maria.sierra', 'password' => '1018451821','id'=>'37','docutipos_id'=>1,'identificacion'=>'1018451821','nombre1'=>'Maria Alejandra','apellido1'=>'Sierra Benitez','telefono'=>'3132235652','direccion'=>'malejasb10@hotmail.com','email'=>'malejasb10@hotmail.com',],
            ['usuario' => 'elisa.torres', 'password' => '35531863','id'=>'38','docutipos_id'=>1,'identificacion'=>'35531863','nombre1'=>'Elisa','apellido1'=>'Torres Paredes','telefono'=>'3013530673','direccion'=>'elisaparedes459@gmail.com','email'=>'elisaparedes459@gmail.com',],
            ['usuario' => 'luz.pita', 'password' => '52751529','id'=>'40','docutipos_id'=>1,'identificacion'=>'52751529','nombre1'=>'Luz Dary','apellido1'=>'Pita Lizarazo','telefono'=>'3165265679','direccion'=>'lupita.cyc@gmail.com','email'=>'lupita.cyc@gmail.com',],
            ['usuario' => 'dennys.nauza', 'password' => '52229631','id'=>'41','docutipos_id'=>1,'identificacion'=>'52229631','nombre1'=>'Dennys Lorena','apellido1'=>'Nauza Rios','telefono'=>'3138791535','direccion'=>'lorenanauza@hotmail.com','email'=>'lorenanauza@hotmail.com',],
            ['usuario' => 'omar.marquez', 'password' => '1066511136','id'=>'42','docutipos_id'=>1,'identificacion'=>'1066511136','nombre1'=>'Omar Alexander','apellido1'=>'Márquez Martínez','telefono'=>'3103181438','direccion'=>'bioinsumoselleuse@gmail.com','email'=>'bioinsumoselleuse@gmail.com',],
            ['usuario' => 'carmen.hernandez', 'password' => '1032461570','id'=>'44','docutipos_id'=>1,'identificacion'=>'1032461570','nombre1'=>'Carmen Lorena','apellido1'=>'Hernandez Wilches','telefono'=>'3192551187','direccion'=>'carmenwilches94@gmail.com','email'=>'carmenwilches94@gmail.com',],
            ['usuario' => 'carolina.morato', 'password' => '1073515210','id'=>'45','docutipos_id'=>1,'identificacion'=>'1073515210','nombre1'=>'Carolina','apellido1'=>'Morato Bolívar','telefono'=>'3134747870','direccion'=>'c.moratto2@gmail.com','email'=>'c.moratto2@gmail.com',],
            ['usuario' => 'derly.bonilla', 'password' => '52806870','id'=>'46','docutipos_id'=>1,'identificacion'=>'52806870','nombre1'=>'Derly Yobana','apellido1'=>'Bonilla Zamora','telefono'=>'3228557566','direccion'=>'derlyjbana18@gmail.com','email'=>'derlyjbana18@gmail.com',],
            ['usuario' => 'johanna.garcia', 'password' => '1073503489','id'=>'47','docutipos_id'=>1,'identificacion'=>'1073503489','nombre1'=>'Johanna Carolina','apellido1'=>'Garcia Mora','telefono'=>'3162274101','direccion'=>'joha.garcia0326@gmail.com','email'=>'joha.garcia0326@gmail.com',],
            ['usuario' => 'natalia.rodriguez', 'password' => '1073515408','id'=>'48','docutipos_id'=>1,'identificacion'=>'1073515408','nombre1'=>'Natalia','apellido1'=>'Rodriguez Pardo','telefono'=>'3195140150','direccion'=>'bemvelo.natural@gmail.com','email'=>'bemvelo.natural@gmail.com',],
            ['usuario' => 'sebastian.mejia', 'password' => '80656884','id'=>'49','docutipos_id'=>1,'identificacion'=>'80656884','nombre1'=>'Sebastian Eduardo','apellido1'=>'Mejia Murillo','telefono'=>'3115104589','direccion'=>'donsebastian40@gmail.com','email'=>'donsebastian40@gmail.com',],
            ['usuario' => 'angelica.portuguez', 'password' => '53062274','id'=>'50','docutipos_id'=>1,'identificacion'=>'53062274','nombre1'=>'Angelica Yadira','apellido1'=>'Portuguez Niño','telefono'=>'3164144280','direccion'=>'ayportuguez@gmail.com','email'=>'ayportuguez@gmail.com',],
            ['usuario' => 'maria.torres', 'password' => '1073527702','id'=>'51','docutipos_id'=>1,'identificacion'=>'1073527702','nombre1'=>'María José','apellido1'=>'Torres Fonseca','telefono'=>'3016407817','direccion'=>'mariat-emperatriz@hotmail.com','email'=>'mariat-emperatriz@hotmail.com',],
            ['usuario' => 'darin.beltran', 'password' => '1073516902','id'=>'52','docutipos_id'=>1,'identificacion'=>'1073516902','nombre1'=>'Darin Eliana','apellido1'=>'Beltrán Riaño','telefono'=>'3222186541','direccion'=>'darineliana@gmail.com','email'=>'darineliana@gmail.com',],
            ['usuario' => 'marlon.angarita', 'password' => '1073505494','id'=>'53','docutipos_id'=>1,'identificacion'=>'1073505494','nombre1'=>'Marlon','apellido1'=>'Angarita','telefono'=>'3005767000','direccion'=>'zaquecerveceria@gmail.com','email'=>'zaquecerveceria@gmail.com',],
            ['usuario' => 'dora.diaz', 'password' => '40987739','id'=>'54','docutipos_id'=>1,'identificacion'=>'40987739','nombre1'=>'Dora Liliana','apellido1'=>'Díaz Suavita','telefono'=>'3175245638','direccion'=>'dolidisu@gmail.com','email'=>'dolidisu@gmail.com',],
            ['usuario' => 'fredy.diaz', 'password' => '1068973254','id'=>'56','docutipos_id'=>1,'identificacion'=>'1068973254','nombre1'=>'Fredy Adrian','apellido1'=>'Díaz Rivera','telefono'=>'3125734258','direccion'=>'08freddydiaz@gmail.com','email'=>'08freddydiaz@gmail.com',],
            ['usuario' => 'evelio.rozo', 'password' => '80656209','id'=>'57','docutipos_id'=>1,'identificacion'=>'80656209','nombre1'=>'Evelio','apellido1'=>'Rozo Cañas','telefono'=>'3125206346','direccion'=>'eveliorozocanas@gmail.com','email'=>'eveliorozocanas@gmail.com',],
            ['usuario' => 'luis.naranjo', 'password' => '80383236','id'=>'58','docutipos_id'=>1,'identificacion'=>'80383236','nombre1'=>'Luis Enrique','apellido1'=>'Naranjo Delgado','telefono'=>'3174393025','direccion'=>'lenaranjod@unal.edu.co','email'=>'lenaranjod@unal.edu.co',],
            ['usuario' => 'orlando.camelo', 'password' => '79306162','id'=>'59','docutipos_id'=>1,'identificacion'=>'79306162','nombre1'=>'Orlando Marin','apellido1'=>'Camelo Cardenas','telefono'=>'3134001108','direccion'=>'orlandom63@homail.com','email'=>'orlandom63@homail.com',],
            ['usuario' => 'yeisson.fuquen', 'password' => '1136888847','id'=>'60','docutipos_id'=>1,'identificacion'=>'1136888847','nombre1'=>'Yeisson Alejandro','apellido1'=>'Fuquen Carrillo','telefono'=>'3204595829','direccion'=>'alejandro-gato27@outlook.es','email'=>'alejandro-gato27@outlook.es',],
            ['usuario' => 'esneda.lopez', 'password' => '52661403','id'=>'61','docutipos_id'=>1,'identificacion'=>'52661403','nombre1'=>'Esneda','apellido1'=>'Lopez Ramírez','telefono'=>'3174359491','direccion'=>'esneda09@hotmail.com','email'=>'esneda09@hotmail.com',],
            ['usuario' => 'claudia.salas', 'password' => '52910368','id'=>'63','docutipos_id'=>1,'identificacion'=>'52910368','nombre1'=>'Claudia Marcela','apellido1'=>'Salas Beltrán','telefono'=>'3057927957','direccion'=>'marcesalas26@gmail.com','email'=>'marcesalas26@gmail.com',],
            ['usuario' => 'flor.torres', 'password' => '1148959570','id'=>'64','docutipos_id'=>1,'identificacion'=>'1148959570','nombre1'=>'Flor Angela','apellido1'=>'Torres Sanchez','telefono'=>'3232210498','direccion'=>'florgranados022@gmail.com','email'=>'florgranados022@gmail.com',],
            ['usuario' => 'paula.reyes', 'password' => '1073511576','id'=>'65','docutipos_id'=>1,'identificacion'=>'1073511576','nombre1'=>'Paula Andrea','apellido1'=>'Reyes Méndez','telefono'=>'3204601886','direccion'=>'chikis921106@gmail.com','email'=>'chikis921106@gmail.com',],
            ['usuario' => 'cristian.vargas', 'password' => '1010246763','id'=>'66','docutipos_id'=>1,'identificacion'=>'1010246763','nombre1'=>'Cristian David','apellido1'=>'Vargas Espinosa','telefono'=>'3124761926','direccion'=>'DASAVARGASPE@GMAIL.COM','email'=>'DASAVARGASPE@GMAIL.COM',],
            ['usuario' => 'jose.quintero', 'password' => '3100540','id'=>'67','docutipos_id'=>1,'identificacion'=>'3100540','nombre1'=>'Jose Vicente','apellido1'=>'Quintero Prieto','telefono'=>'3196228898','direccion'=>'jvmoncho95@gmail.com','email'=>'jvmoncho95@gmail.com',],
        ];
        foreach ($emprendedores as $emprendedor) {
            $user = User::create([
                'name' => $emprendedor['nombre1'].' '.$emprendedor['apellido1'],
                'username' => $emprendedor['usuario'],
                'email' => $emprendedor['email'],
                'password' => bcrypt($emprendedor['identificacion']),
            ])->syncRoles(['Emprendedor']);

            Persona::create([
                'id' => $user->id,
                'docutipos_id' => 1,
                'identificacion' => $emprendedor['identificacion'],
                'nombre1' => $emprendedor['nombre1'],
                'apellido1' => $emprendedor['apellido1'],
                'telefono' => $emprendedor['telefono'],
                'email' => $emprendedor['email'],
                'ups' => $emprendedor['identificacion'],

            ]);
        }
        //------------------------------------------------------
    }
}
