namespace ProjectManager
{
    partial class AddEditForm
    {
        /// <summary>
        /// Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// Clean up any resources being used.
        /// </summary>
        /// <param name="disposing">true if managed resources should be disposed; otherwise, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Windows Form Designer generated code

        /// <summary>
        /// Required method for Designer support - do not modify
        /// the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            this.lbl_title = new System.Windows.Forms.Label();
            this.label2 = new System.Windows.Forms.Label();
            this.label3 = new System.Windows.Forms.Label();
            this.label4 = new System.Windows.Forms.Label();
            this.label5 = new System.Windows.Forms.Label();
            this.lbl_ucesnik = new System.Windows.Forms.Label();
            this.cb_ucesnik = new System.Windows.Forms.ComboBox();
            this.cb_zadatak = new System.Windows.Forms.ComboBox();
            this.tb_opis = new System.Windows.Forms.TextBox();
            this.dp_datum = new System.Windows.Forms.DateTimePicker();
            this.cb_postoji = new System.Windows.Forms.CheckBox();
            this.btn_add_edit = new System.Windows.Forms.Button();
            this.btn_cancel = new System.Windows.Forms.Button();
            this.nud_potroseno_vremena = new System.Windows.Forms.NumericUpDown();
            ((System.ComponentModel.ISupportInitialize)(this.nud_potroseno_vremena)).BeginInit();
            this.SuspendLayout();
            // 
            // lbl_title
            // 
            this.lbl_title.AutoSize = true;
            this.lbl_title.Location = new System.Drawing.Point(159, 9);
            this.lbl_title.Name = "lbl_title";
            this.lbl_title.Size = new System.Drawing.Size(0, 13);
            this.lbl_title.TabIndex = 0;
            // 
            // label2
            // 
            this.label2.AutoSize = true;
            this.label2.Location = new System.Drawing.Point(12, 75);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(47, 13);
            this.label2.TabIndex = 1;
            this.label2.Text = "Zadatak";
            // 
            // label3
            // 
            this.label3.AutoSize = true;
            this.label3.Location = new System.Drawing.Point(12, 102);
            this.label3.Name = "label3";
            this.label3.Size = new System.Drawing.Size(28, 13);
            this.label3.TabIndex = 2;
            this.label3.Text = "Opis";
            // 
            // label4
            // 
            this.label4.AutoSize = true;
            this.label4.Location = new System.Drawing.Point(12, 168);
            this.label4.Name = "label4";
            this.label4.Size = new System.Drawing.Size(100, 13);
            this.label4.TabIndex = 3;
            this.label4.Text = "Potroseno Vremena";
            // 
            // label5
            // 
            this.label5.AutoSize = true;
            this.label5.Location = new System.Drawing.Point(12, 197);
            this.label5.Name = "label5";
            this.label5.Size = new System.Drawing.Size(38, 13);
            this.label5.TabIndex = 4;
            this.label5.Text = "Datum";
            // 
            // lbl_ucesnik
            // 
            this.lbl_ucesnik.AutoSize = true;
            this.lbl_ucesnik.Location = new System.Drawing.Point(12, 48);
            this.lbl_ucesnik.Name = "lbl_ucesnik";
            this.lbl_ucesnik.Size = new System.Drawing.Size(46, 13);
            this.lbl_ucesnik.TabIndex = 5;
            this.lbl_ucesnik.Text = "Ucesnik";
            // 
            // cb_ucesnik
            // 
            this.cb_ucesnik.FormattingEnabled = true;
            this.cb_ucesnik.Location = new System.Drawing.Point(118, 45);
            this.cb_ucesnik.Name = "cb_ucesnik";
            this.cb_ucesnik.Size = new System.Drawing.Size(200, 21);
            this.cb_ucesnik.TabIndex = 7;
            // 
            // cb_zadatak
            // 
            this.cb_zadatak.FormattingEnabled = true;
            this.cb_zadatak.Location = new System.Drawing.Point(118, 72);
            this.cb_zadatak.Name = "cb_zadatak";
            this.cb_zadatak.Size = new System.Drawing.Size(200, 21);
            this.cb_zadatak.TabIndex = 8;
            // 
            // tb_opis
            // 
            this.tb_opis.Location = new System.Drawing.Point(118, 99);
            this.tb_opis.Multiline = true;
            this.tb_opis.Name = "tb_opis";
            this.tb_opis.Size = new System.Drawing.Size(200, 60);
            this.tb_opis.TabIndex = 9;
            // 
            // dp_datum
            // 
            this.dp_datum.Location = new System.Drawing.Point(118, 190);
            this.dp_datum.Name = "dp_datum";
            this.dp_datum.Size = new System.Drawing.Size(200, 20);
            this.dp_datum.TabIndex = 11;
            // 
            // cb_postoji
            // 
            this.cb_postoji.AutoSize = true;
            this.cb_postoji.Location = new System.Drawing.Point(118, 216);
            this.cb_postoji.Name = "cb_postoji";
            this.cb_postoji.Size = new System.Drawing.Size(57, 17);
            this.cb_postoji.TabIndex = 12;
            this.cb_postoji.Text = "Postoji";
            this.cb_postoji.UseVisualStyleBackColor = true;
            // 
            // btn_add_edit
            // 
            this.btn_add_edit.Location = new System.Drawing.Point(162, 276);
            this.btn_add_edit.Name = "btn_add_edit";
            this.btn_add_edit.Size = new System.Drawing.Size(75, 23);
            this.btn_add_edit.TabIndex = 13;
            this.btn_add_edit.UseVisualStyleBackColor = true;
            this.btn_add_edit.Click += new System.EventHandler(this.btn_add_edit_Click);
            // 
            // btn_cancel
            // 
            this.btn_cancel.Location = new System.Drawing.Point(245, 276);
            this.btn_cancel.Name = "btn_cancel";
            this.btn_cancel.Size = new System.Drawing.Size(75, 23);
            this.btn_cancel.TabIndex = 14;
            this.btn_cancel.Text = "Odbaci";
            this.btn_cancel.UseVisualStyleBackColor = true;
            this.btn_cancel.Click += new System.EventHandler(this.btn_cancel_Click);
            // 
            // nud_potroseno_vremena
            // 
            this.nud_potroseno_vremena.Location = new System.Drawing.Point(118, 166);
            this.nud_potroseno_vremena.Name = "nud_potroseno_vremena";
            this.nud_potroseno_vremena.Size = new System.Drawing.Size(200, 20);
            this.nud_potroseno_vremena.TabIndex = 15;
            // 
            // AddEditForm
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(332, 311);
            this.Controls.Add(this.nud_potroseno_vremena);
            this.Controls.Add(this.btn_cancel);
            this.Controls.Add(this.btn_add_edit);
            this.Controls.Add(this.cb_postoji);
            this.Controls.Add(this.dp_datum);
            this.Controls.Add(this.tb_opis);
            this.Controls.Add(this.cb_zadatak);
            this.Controls.Add(this.cb_ucesnik);
            this.Controls.Add(this.lbl_ucesnik);
            this.Controls.Add(this.label5);
            this.Controls.Add(this.label4);
            this.Controls.Add(this.label3);
            this.Controls.Add(this.label2);
            this.Controls.Add(this.lbl_title);
            this.FormBorderStyle = System.Windows.Forms.FormBorderStyle.FixedSingle;
            this.Name = "AddEditForm";
            this.StartPosition = System.Windows.Forms.FormStartPosition.CenterScreen;
            this.Text = "Aktivnost";
            this.Load += new System.EventHandler(this.AddEditForm_Load);
            ((System.ComponentModel.ISupportInitialize)(this.nud_potroseno_vremena)).EndInit();
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.Label lbl_title;
        private System.Windows.Forms.Label label2;
        private System.Windows.Forms.Label label3;
        private System.Windows.Forms.Label label4;
        private System.Windows.Forms.Label label5;
        private System.Windows.Forms.Label lbl_ucesnik;
        private System.Windows.Forms.ComboBox cb_ucesnik;
        private System.Windows.Forms.ComboBox cb_zadatak;
        private System.Windows.Forms.TextBox tb_opis;
        private System.Windows.Forms.DateTimePicker dp_datum;
        private System.Windows.Forms.CheckBox cb_postoji;
        private System.Windows.Forms.Button btn_add_edit;
        private System.Windows.Forms.Button btn_cancel;
        private System.Windows.Forms.NumericUpDown nud_potroseno_vremena;
    }
}