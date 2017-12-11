
package conexion;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;
import java.util.logging.Level;
import java.util.logging.Logger;

/**
 *
 * @author jarteaga
 * Clase que hace de puente entre el servidor de base de datos y el reporte (JasperReport)
 */
public class Conexion 
{
    
   private final String bd = "almacen";// Nombre de la base de datos
   private final String login = "root";            //Login de la Base de datos
   private final String password = "@admin1.@";         // Clave de la base de datos
      private final String url = "jdbc:mysql://192.168.1.128/"+bd; 
  //private final String url = "jdbc:postgresql://192.168.1.128:5432/"+bd; 
  // private final String url = "jdbc:postgresql://192.168.1.249:5432/"+bd;
   private Connection conn = null;
   //private Statement estatuto;
   

   /** Constructor de DbConnection */
   public Conexion() {
      try{
         //obtenemos el driver de para postgres
         Class.forName("com.mysql.jdbc.Driver");
         //obtenemos la conexión
         conn = DriverManager.getConnection(url,login,password);
         if (conn!=null){
            System.out.println("Conexión a base de datos "+bd+". listo");
         }
      }catch(  SQLException | ClassNotFoundException e){
         System.out.println(e);
      }
   }
   /**Permite retornar la conexión*/
   public Connection getConnection(){
      return conn;
   }

   public void desconectar(){
        try {
            conn.close();
            //estatuto.close();
        } catch (SQLException ex) {
            Logger.getLogger(Conexion.class.getName()).log(Level.SEVERE, null, ex);
        }
      
      
      System.out.println("La conexion a la  base de datos "+bd+" a terminado");
   }
    
}
