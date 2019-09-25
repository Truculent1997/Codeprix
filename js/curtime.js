string URL ="http://www.google.com";
System.Net.HttpWebRequest rq2 = (System.Net.HttpWebRequest)System.Net.WebRequest.Create(URL);
System.Net.HttpWebResponse res2 = (System.Net.HttpWebResponse)rq2.GetResponse();
DateTime Date = DateTime.Parse(res2.Headers["Date"]);
