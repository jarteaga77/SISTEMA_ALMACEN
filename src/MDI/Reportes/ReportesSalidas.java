
package MDI.Reportes;

import java.net.URL;
import java.util.Date;
import java.util.HashMap;
import java.util.Map;
import net.sf.jasperreports.engine.JRException;
import net.sf.jasperreports.engine.JasperFillManager;
import net.sf.jasperreports.engine.JasperPrint;
import net.sf.jasperreports.engine.JasperReport;
import net.sf.jasperreports.engine.util.JRLoader;
import net.sf.jasperreports.view.JasperViewer;
import conexion.Conexion;

/**
 *
 * @author jarteaga
 */
public class ReportesSalidas 

{
  private Conexion nueva=new Conexion();
 // private final String logo="/sysctp/presentacion/recursos/encabezado.png";
    
    public void ejecutarReporte(Date fechaIni, Date fechaFin)
    {
        try
        {
        JasperReport reporte;
        JasperReport subreporte;
        JasperPrint reporte_view;
        
        URL  in = this.getClass().getResource("/MDI/Reportes/ReportSalidaGeneral.jasper");
        reporte = (JasperReport) JRLoader.loadObject( in );
        URL  in1 = this.getClass().getResource("/MDI/Reportes/SubreporteSalidaGeneral.jasper");//Ruta del reporte maestro
        subreporte = (JasperReport) JRLoader.loadObject( in1 );
        
        
        
         Map parametros = new HashMap();
         parametros.clear();
         parametros.put("fecha_ini",fechaIni);
         parametros.put("fecha_fin",fechaFin);
       //  parametros.put("logo", this.getClass().getResourceAsStream(logo));
         parametros.put("subreporte",subreporte);
         
         reporte_view= JasperFillManager.fillReport(reporte, parametros, nueva.getConnection());
         //JasperViewer.viewReport(reporte_view , false );
         JasperViewer jviewer = new JasperViewer(reporte_view,false);
         jviewer.setTitle("Salidas de Almacen--UTD");
         jviewer.setVisible(true);
         
         nueva.desconectar();

        
        }catch(JRException e)
        {
            System.out.println(e);
        }
    }
 
}
