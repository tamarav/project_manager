using System;
using Soap;
using System.Collections.Generic;
using System.Collections.Specialized;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Net;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace ProjectManager
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }

        private void btn_close_Click(object sender, EventArgs e)
        {
            this.Close();
        }

        private void btn_login_Click(object sender, EventArgs e)
        {
            string username = this.txt_username.Text;
            string password = this.txt_password.Text;

            bool success = SOAP.SOAP.sendRequest(username, password);

            if (success)
            {
                ProjectsForm form = new ProjectsForm(username, password);
                
                form.Show();
                this.Hide();
            }
            else
            {
                this.lbl_info.Text = "Wrong username or password!";
            }
        }
        private void txt_username_KeyPress(object sender, KeyPressEventArgs e)
        {
            if (e.KeyChar == (char)13)
            {
                this.btn_login_Click(sender, e);
            }
        }

        private void txt_password_KeyPress(object sender, KeyPressEventArgs e)
        {
            if (e.KeyChar == (char)13)
            {
                this.btn_login_Click(sender, e);
            }
        }
    }
}
