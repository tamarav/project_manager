using Soap;
using System;
using System.Collections;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Net;
using System.Text;
using System.Threading.Tasks;
using System.Xml;
using System.Xml.Linq;

namespace ProjectManager.SOAP
{
    class SOAP
    {
        public User korisnik = null;
        public static bool sendRequest(string username, string password)
        {
            SoapClient client = new SoapClient("http://pisio.etfbl.net/~tamarav/lab7/servis");
            System.Xml.Linq.XElement xml = client.Invoke("wsLogin", username, password);

            if (xml != null)
            {
                IEnumerable<XElement> item = xml.Descendants("return");
                foreach (XElement i in item)
                {
                    int val = 0;
                    if (i.Value == "false")
                    {
                        return false;
                    }
                    else if(int.TryParse(i.Value, out val))
                    {
                        User.setId(val);
                        return true;
                    }
                }
            }
            return false;
        }


        public static ArrayList getActivities(string korisnicko_ime, string lozinka)
        {   
            
            SoapClient client = new SoapClient("http://pisio.etfbl.net/~tamarav/lab7/servis");
            System.Xml.Linq.XElement xml = client.Invoke("getMyActivities", korisnicko_ime, lozinka, User.getId());
            ArrayList projects = new ArrayList();

            Dictionary<string, string> elements = null;

            if (xml != null)
            {
                IEnumerable<XElement> items = xml.Descendants("item");
                foreach (XElement item in items)
                {
                    elements = new Dictionary<string, string>();
                    IEnumerable<XElement> query = from xe in item.Descendants()
                                                  from n in xe.Elements()
                                                  select n;

                    string k = "";
                    foreach (XElement xe in query)
                    {
                        if (xe.Name == "key")
                        {
                            k = xe.Value;
                        }
                        else if (xe.Name == "value")
                        {
                            if (!k.Equals(""))
                            {
                                elements.Add(k, xe.Value);
                            }
                        }
                    }

                    projects.Add(elements);

                }

                /*foreach (Dictionary<string, string> p in projects)
                {
                    foreach (var el in p)
                    {
                        Console.WriteLine(el.Key + " = " + el.Value);
                    }
                }*/
            }

            return projects;
        }

        public static string getTaskName(string korisnico_ime, string lozinka, int id) 
        {
            SoapClient client = new SoapClient("http://pisio.etfbl.net/~tamarav/lab7/servis");
            System.Xml.Linq.XElement xml = client.Invoke("getZadatakName", korisnico_ime, lozinka, id);

            if (xml != null)
            {
                IEnumerable<XElement> item = xml.Descendants("return");
                foreach (XElement i in item)
                {
                    int val = 0;
                    if (i.Value == "")
                    {
                        return "";
                    }
                    else
                    {
                       
                        return i.Value;
                    }
                }
            }
            return xml.ToString();
        }

        public static ArrayList getRadnici(string korisnicko_ime, string lozinka)
        {
            SoapClient client = new SoapClient("http://pisio.etfbl.net/~tamarav/lab7/servis");
            System.Xml.Linq.XElement xml = client.Invoke("getRadnici", korisnicko_ime, lozinka, User.getId());

            ArrayList radnici = new ArrayList();

            Dictionary<string, string> elements = null;

            if (xml != null)
            {
                IEnumerable<XElement> items = xml.Descendants("item");
                foreach (XElement item in items)
                {
                    elements = new Dictionary<string, string>();
                    IEnumerable<XElement> query = from xe in item.Descendants()
                                                  from n in xe.Elements()
                                                  select n;

                    string k = "";
                    foreach (XElement xe in query)
                    {
                        if (xe.Name == "key")
                        {
                            k = xe.Value;
                        }
                        else if (xe.Name == "value")
                        {
                            if (!k.Equals(""))
                            {
                                elements.Add(k, xe.Value);
                            }
                        }
                    }

                    radnici.Add(elements);

                }
            }

            return radnici;
        }

        public static ArrayList getZadaci(string korisnicko_ime, string lozinka)
        {
            SoapClient client = new SoapClient("http://pisio.etfbl.net/~tamarav/lab7/servis");
            System.Xml.Linq.XElement xml = client.Invoke("getZadaci", korisnicko_ime, lozinka);

            ArrayList zadaci = new ArrayList();

            Dictionary<string, string> elements = null;

            if (xml != null)
            {
                IEnumerable<XElement> items = xml.Descendants("item");
                foreach (XElement item in items)
                {
                    elements = new Dictionary<string, string>();
                    IEnumerable<XElement> query = from xe in item.Descendants()
                                                  from n in xe.Elements()
                                                  select n;

                    string k = "";
                    foreach (XElement xe in query)
                    {
                        if (xe.Name == "key")
                        {
                            k = xe.Value;
                        }
                        else if (xe.Name == "value")
                        {
                            if (!k.Equals(""))
                            {
                                elements.Add(k, xe.Value);
                            }
                        }
                    }

                    zadaci.Add(elements);

                }
            }
            return zadaci;
        }

        public static Dictionary<string, string> getUser(string korisnicko_ime, string lozinka, int id) {
            SoapClient client = new SoapClient("http://pisio.etfbl.net/~tamarav/lab7/servis");
            System.Xml.Linq.XElement xml = client.Invoke("getUser", korisnicko_ime, lozinka, id);
            ArrayList zadaci = new ArrayList();

            Dictionary<string, string> elements = null;

            if (xml != null)
            {
                IEnumerable<XElement> items = xml.Descendants("item");
                foreach (XElement item in items)
                {
                    elements = new Dictionary<string, string>();
                    IEnumerable<XElement> query = from xe in item.Descendants()
                                                  from n in xe.Elements()
                                                  select n;

                    string k = "";
                    foreach (XElement xe in query)
                    {
                        if (xe.Name == "key")
                        {
                            k = xe.Value;
                        }
                        else if (xe.Name == "value")
                        {
                            if (!k.Equals(""))
                            {
                                elements.Add(k, xe.Value);
                            }
                        }
                    }
                    foreach (var el in elements)
                    {
                        Console.WriteLine("------------------");
                        Console.WriteLine(el.Key + " = " + el.Value);
                    }
                    return elements;
                }
            }
            return null;
        }



        public static bool saveActivity(string korisnicko_ime, string lozinka, int id, int ucesnik_id, int zadatak_id, string opis, string potroseno_vremena,
            string datum, int postoji)
        {
            SoapClient client = new SoapClient("http://pisio.etfbl.net/~tamarav/lab7/servis");
            System.Xml.Linq.XElement xml = client.Invoke("saveActivity",korisnicko_ime, lozinka, id, ucesnik_id, zadatak_id,
            opis, potroseno_vremena, datum, postoji);

            if (xml != null)
            {
                IEnumerable<XElement> item = xml.Descendants("return");
                foreach (XElement i in item)
                {
                    if (i.Value == "false")
                    {
                        return false;
                    }
                    else if (i.Value == "true")
                    {
                        return true;
                    }
                }
            }
            return false;
        }
        public static bool deleteActivity(string korisnicko_ime, string lozinka, int id) 
        {
            SoapClient client = new SoapClient("http://pisio.etfbl.net/~tamarav/lab7/servis");
            System.Xml.Linq.XElement xml = client.Invoke("deleteActivity", korisnicko_ime, lozinka, id);

            if (xml != null)
            {
                IEnumerable<XElement> item = xml.Descendants("return");
                foreach (XElement i in item)
                {
                    if (i.Value == "false")
                    {
                        return false;
                    }
                    else if (i.Value == "true")
                    {
                        return true;
                    }
                }
            }
            return false;
        }
    }
}
