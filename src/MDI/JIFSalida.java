/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package MDI;

import MDI.Reportes.ReportesSalidas;
import MDI.Reportes.sistemas.ReportesSalidaSistemas;
import MDI.Reportes.electrico.ReportesSalidaElectrico;
import MDI.Reportes.mecanica.ReportesSalidaMecanica;
import java.util.Date;
import javax.swing.JOptionPane;

/**
 *
 * @author Jonathan
 */
public class JIFSalida extends javax.swing.JInternalFrame {

    private ReportesSalidas reporte;
    private ReportesSalidaSistemas reporteSistemas;
    private ReportesSalidaElectrico reporteElectrico;
    private ReportesSalidaMecanica reporteMecanica;
    public JIFSalida() {
        initComponents();
    }

    /**
     * This method is called from within the constructor to initialize the form.
     * WARNING: Do NOT modify this code. The content of this method is always
     * regenerated by the Form Editor.
     */
    @SuppressWarnings("unchecked")
    // <editor-fold defaultstate="collapsed" desc="Generated Code">//GEN-BEGIN:initComponents
    private void initComponents() {

        buttonGroup1 = new javax.swing.ButtonGroup();
        jPanel1 = new javax.swing.JPanel();
        jLabel1 = new javax.swing.JLabel();
        jLabel2 = new javax.swing.JLabel();
        dc_fechaInicio = new com.toedter.calendar.JDateChooser();
        dc_fechafin = new com.toedter.calendar.JDateChooser();
        bt_generar = new javax.swing.JButton();
        chb_salida_general = new javax.swing.JCheckBox();
        jLabel4 = new javax.swing.JLabel();
        chb_salida_sistemas = new javax.swing.JCheckBox();
        chb_salida_elect = new javax.swing.JCheckBox();
        chb_mecanica = new javax.swing.JCheckBox();

        setClosable(true);
        setIconifiable(true);
        setTitle("Reportes Ordenes de Salida");

        jPanel1.setBorder(new javax.swing.border.SoftBevelBorder(javax.swing.border.BevelBorder.RAISED));

        jLabel1.setText("Fecha Inicio");

        jLabel2.setText("Fecha Fin");

        bt_generar.setText("Generar");
        bt_generar.setCursor(new java.awt.Cursor(java.awt.Cursor.HAND_CURSOR));
        bt_generar.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                bt_generarActionPerformed(evt);
            }
        });

        buttonGroup1.add(chb_salida_general);
        chb_salida_general.setText("Orden de salida General");

        jLabel4.setText("REPORTES");

        buttonGroup1.add(chb_salida_sistemas);
        chb_salida_sistemas.setText("Orden de salida Sistemas");

        buttonGroup1.add(chb_salida_elect);
        chb_salida_elect.setText("Orden de Salida Eléctricos");

        buttonGroup1.add(chb_mecanica);
        chb_mecanica.setText("Hoja Mto. Mecánica");

        javax.swing.GroupLayout jPanel1Layout = new javax.swing.GroupLayout(jPanel1);
        jPanel1.setLayout(jPanel1Layout);
        jPanel1Layout.setHorizontalGroup(
            jPanel1Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(jPanel1Layout.createSequentialGroup()
                .addContainerGap()
                .addGroup(jPanel1Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                    .addComponent(chb_salida_elect)
                    .addComponent(chb_salida_sistemas)
                    .addComponent(jLabel4)
                    .addGroup(jPanel1Layout.createSequentialGroup()
                        .addComponent(chb_salida_general)
                        .addGap(18, 18, 18)
                        .addComponent(chb_mecanica))
                    .addGroup(jPanel1Layout.createSequentialGroup()
                        .addComponent(jLabel1)
                        .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.UNRELATED)
                        .addComponent(dc_fechaInicio, javax.swing.GroupLayout.PREFERRED_SIZE, 120, javax.swing.GroupLayout.PREFERRED_SIZE)
                        .addGap(12, 12, 12)
                        .addComponent(jLabel2)
                        .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.UNRELATED)
                        .addComponent(dc_fechafin, javax.swing.GroupLayout.PREFERRED_SIZE, 120, javax.swing.GroupLayout.PREFERRED_SIZE)
                        .addGap(32, 32, 32)
                        .addComponent(bt_generar)))
                .addGap(33, 33, Short.MAX_VALUE))
        );
        jPanel1Layout.setVerticalGroup(
            jPanel1Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(jPanel1Layout.createSequentialGroup()
                .addGap(36, 36, 36)
                .addGroup(jPanel1Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                    .addGroup(jPanel1Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.TRAILING)
                        .addComponent(dc_fechafin, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE)
                        .addGroup(jPanel1Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                            .addComponent(dc_fechaInicio, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE)
                            .addComponent(jLabel2)
                            .addComponent(jLabel1)))
                    .addComponent(bt_generar))
                .addGap(26, 26, 26)
                .addComponent(jLabel4)
                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.UNRELATED)
                .addGroup(jPanel1Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                    .addComponent(chb_salida_general)
                    .addComponent(chb_mecanica))
                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.UNRELATED)
                .addComponent(chb_salida_sistemas)
                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.UNRELATED)
                .addComponent(chb_salida_elect)
                .addContainerGap(15, Short.MAX_VALUE))
        );

        javax.swing.GroupLayout layout = new javax.swing.GroupLayout(getContentPane());
        getContentPane().setLayout(layout);
        layout.setHorizontalGroup(
            layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addComponent(jPanel1, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE)
        );
        layout.setVerticalGroup(
            layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(layout.createSequentialGroup()
                .addComponent(jPanel1, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE)
                .addGap(0, 0, Short.MAX_VALUE))
        );

        pack();
    }// </editor-fold>//GEN-END:initComponents

    private void bt_generarActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_bt_generarActionPerformed

        Date fecha_ini=dc_fechaInicio.getDate();
        Date fecha_fin=dc_fechafin.getDate();

        if(dc_fechaInicio.getDate() == null && dc_fechafin.getDate()== null)
        {
            JOptionPane.showMessageDialog(this, "Seleccione el rango de fecha","Error", JOptionPane.ERROR_MESSAGE);
        }

        else if(fecha_fin.before(fecha_ini) )
        {
            JOptionPane.showMessageDialog(this, "La fecha Final debe ser mayor que la inicial", "Error", JOptionPane.ERROR_MESSAGE);
        }

        if(chb_salida_general.isSelected()==true)
        {

            reporte=new ReportesSalidas();
            reporte.ejecutarReporte(fecha_ini, fecha_fin);

        }

        else if(chb_salida_elect.isSelected()==true)
        {

            reporteElectrico=new ReportesSalidaElectrico();
            reporteElectrico.ejecutarReporte(fecha_ini, fecha_fin);
        }

        else  if(chb_salida_sistemas.isSelected()==true)
        {

            reporteSistemas=new ReportesSalidaSistemas();
            reporteSistemas.ejecutarReporte(fecha_ini, fecha_fin);
        }
        
         else  if(chb_mecanica.isSelected()==true)
        {

            reporteMecanica=new ReportesSalidaMecanica();
            reporteMecanica.ejecutarReporte(fecha_ini, fecha_fin);
        }
        
        else
        {
            JOptionPane.showMessageDialog(this, "Seleccione un Reporte", "Error", JOptionPane.ERROR_MESSAGE);
        }

    }//GEN-LAST:event_bt_generarActionPerformed


    // Variables declaration - do not modify//GEN-BEGIN:variables
    private javax.swing.JButton bt_generar;
    private javax.swing.ButtonGroup buttonGroup1;
    private javax.swing.JCheckBox chb_mecanica;
    private javax.swing.JCheckBox chb_salida_elect;
    private javax.swing.JCheckBox chb_salida_general;
    private javax.swing.JCheckBox chb_salida_sistemas;
    private com.toedter.calendar.JDateChooser dc_fechaInicio;
    private com.toedter.calendar.JDateChooser dc_fechafin;
    private javax.swing.JLabel jLabel1;
    private javax.swing.JLabel jLabel2;
    private javax.swing.JLabel jLabel4;
    private javax.swing.JPanel jPanel1;
    // End of variables declaration//GEN-END:variables
}