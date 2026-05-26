import { useState } from "react";
import Navbar from "@/components/Navbar";
import Footer from "@/components/Footer";
import { Phone, Mail, MapPin, Clock, Send, Instagram, Linkedin, MessageCircle } from "lucide-react";
import { motion } from "framer-motion";
import { apiRequest, type ApiError } from "@/lib/api";
import { toast } from "@/components/ui/sonner";

const contactInfo = [
  { icon: Phone, label: "Phone", value: "9827240324", href: "tel:+919827240324" },
  { icon: Mail, label: "Email", value: "empathyhub.in@gmail.com", href: "mailto:empathyhub.in@gmail.com" },
  { icon: MapPin, label: "Address", value: "Indore, Madhya Pradesh 452012" },
  { icon: Clock, label: "Hours", value: "Mon - Sat: 3 PM - 7 PM" },
];

const socialLinks = [
  { icon: Instagram, label: "Instagram", href: "https://www.instagram.com/empathyhub.in?utm_source=qr&igsh=MXVxeXVsMTZzaGF6cA==", color: "bg-gradient-to-tr from-yellow-400 via-orange-500 to-pink-600" },
  { icon: Linkedin, label: "LinkedIn", href: "https://www.linkedin.com/in/mayuri-soni-a89ba337b?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app", color: "bg-blue-600" },
  { icon: MessageCircle, label: "WhatsApp", href: "https://wa.me/919827240324", color: "bg-green-500" },
];

const queryTopics = [
  "General Inquiry",
  "Therapy Sessions",
  "Pricing & Packages",
  "Insurance & Payment",
  "Therapist Availability",
  "Corporate Wellness",
  "Feedback / Complaint",
  "Other",
];

const Contact = () => {
  const [isSubmitting, setIsSubmitting] = useState(false);
  const [formData, setFormData] = useState({
    fullName: "",
    email: "",
    phone: "",
    topic: "",
    message: "",
  });

  const handleChange = (e: React.ChangeEvent<HTMLInputElement | HTMLTextAreaElement | HTMLSelectElement>) => {
    setFormData({ ...formData, [e.target.name]: e.target.value });
  };

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();

    try {
      setIsSubmitting(true);
      const data = await apiRequest<{ message: string }>("/contact", {
        method: "POST",
        body: JSON.stringify({
          full_name: formData.fullName,
          email: formData.email,
          phone: formData.phone,
          topic: formData.topic,
          message: formData.message,
        }),
      });

      toast.success(data.message);
      setFormData({
        fullName: "",
        email: "",
        phone: "",
        topic: "",
        message: "",
      });
    } catch (err) {
      toast.error((err as ApiError).message);
    } finally {
      setIsSubmitting(false);
    }
  };

  return (
    <div className="min-h-screen bg-background">
      <Navbar />

      <section className="pt-32 pb-20 px-6">
        <div className="max-w-6xl mx-auto">
          <motion.div
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            className="text-center mb-16"
          >
            <span className="text-primary font-body text-sm uppercase tracking-widest">Get in Touch</span>
            <h1 className="font-heading text-4xl md:text-5xl text-foreground mt-4 mb-6">
              We'd Love to Hear From You
            </h1>
            <p className="text-muted-foreground font-body max-w-2xl mx-auto text-lg">
              Have a question, need support, or want to book a session? Fill out the form and our team will get back to you within 24 hours.
            </p>
          </motion.div>

          <div className="grid lg:grid-cols-5 gap-12">
            <motion.div
              initial={{ opacity: 0, x: -30 }}
              animate={{ opacity: 1, x: 0 }}
              transition={{ delay: 0.2 }}
              className="lg:col-span-2 space-y-5"
            >
              <h2 className="font-heading text-2xl text-foreground mb-6">Contact Information</h2>
              {contactInfo.map((item, i) => (
                <div key={i} className="flex items-start gap-4 p-5 bg-card rounded-2xl border border-border">
                  <div className="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center flex-shrink-0">
                    <item.icon className="w-5 h-5 text-primary" />
                  </div>
                  <div>
                    <p className="font-body text-sm text-muted-foreground">{item.label}</p>
                    {item.href ? (
                      <a href={item.href} className="font-body text-foreground hover:text-primary transition-colors">
                        {item.value}
                      </a>
                    ) : (
                      <p className="font-body text-foreground">{item.value}</p>
                    )}
                  </div>
                </div>
              ))}

              <div className="rounded-2xl overflow-hidden border border-border h-[250px] bg-muted">
                <iframe
                  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d117763.67471091678!2d75.86384989999999!3d22.723972749999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0x3962fd044d9b6e33%3A0x46cc223e6cec9d34!2sEmpathy%20Hub%2C%20SCHEME%20NO.%2097%2C%20Part%204%2C%20370-A%2C%20Vip%20Paraspar%20Nagar%2C%20Indore%2C%20Madhya%20Pradesh%20452012!3m2!1d22.675750999999998!2d75.8229209!5e0!3m2!1sen!2sin!4v1777697418960!5m2!1sen!2sin"
                  width="100%"
                  height="100%"
                  style={{ border: 0 }}
                  allowFullScreen
                  loading="lazy"
                  referrerPolicy="no-referrer-when-downgrade"
                  title="Empathy Hub Location"
                />
              </div>

              <div className="mt-6">
                <h3 className="font-heading text-lg text-foreground mb-4">Follow Us</h3>
                <div className="flex gap-3">
                  {socialLinks.map((social, i) => (
                    <a
                      key={i}
                      href={social.href}
                      target="_blank"
                      rel="noopener noreferrer"
                      className={`${social.color} p-3 rounded-xl text-white hover:opacity-90 transition-opacity flex items-center justify-center`}
                      aria-label={social.label}
                    >
                      <social.icon size={20} />
                    </a>
                  ))}
                </div>
              </div>
            </motion.div>

            <motion.div
              initial={{ opacity: 0, x: 30 }}
              animate={{ opacity: 1, x: 0 }}
              transition={{ delay: 0.3 }}
              className="lg:col-span-3"
            >
              <div className="bg-card rounded-3xl border border-border p-8 md:p-10">
                <h2 className="font-heading text-2xl text-foreground mb-2">Send Us a Message</h2>
                <p className="font-body text-muted-foreground text-sm mb-8">Fill in the details below and we'll respond shortly.</p>

                <form onSubmit={handleSubmit} className="space-y-5">
                  <div className="grid sm:grid-cols-2 gap-5">
                    <div>
                      <label className="block font-body text-sm text-foreground mb-2">
                        Full Name <span className="text-destructive">*</span>
                      </label>
                      <input
                        type="text"
                        name="fullName"
                        required
                        value={formData.fullName}
                        onChange={handleChange}
                        placeholder="Enter your full name"
                        className="w-full px-4 py-3 rounded-xl border border-border bg-background text-foreground font-body placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all"
                      />
                    </div>
                    <div>
                      <label className="block font-body text-sm text-foreground mb-2">
                        Email Address <span className="text-destructive">*</span>
                      </label>
                      <input
                        type="email"
                        name="email"
                        required
                        value={formData.email}
                        onChange={handleChange}
                        placeholder="you@example.com"
                        className="w-full px-4 py-3 rounded-xl border border-border bg-background text-foreground font-body placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all"
                      />
                    </div>
                  </div>

                  <div className="grid sm:grid-cols-2 gap-5">
                    <div>
                      <label className="block font-body text-sm text-foreground mb-2">
                        Phone Number <span className="text-destructive">*</span>
                      </label>
                      <input
                        type="tel"
                        name="phone"
                        required
                        value={formData.phone}
                        onChange={handleChange}
                        placeholder="+91 98765 43210"
                        className="w-full px-4 py-3 rounded-xl border border-border bg-background text-foreground font-body placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all"
                      />
                    </div>
                    <div>
                      <label className="block font-body text-sm text-foreground mb-2">
                        Query Topic <span className="text-destructive">*</span>
                      </label>
                      <select
                        name="topic"
                        required
                        value={formData.topic}
                        onChange={handleChange}
                        className="w-full px-4 py-3 rounded-xl border border-border bg-background text-foreground font-body focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all appearance-none"
                      >
                        <option value="" disabled>Select a topic</option>
                        {queryTopics.map((topic) => (
                          <option key={topic} value={topic}>{topic}</option>
                        ))}
                      </select>
                    </div>
                  </div>

                  <div>
                    <label className="block font-body text-sm text-foreground mb-2">
                      Your Message <span className="text-destructive">*</span>
                    </label>
                    <textarea
                      name="message"
                      required
                      rows={5}
                      value={formData.message}
                      onChange={handleChange}
                      placeholder="Describe your query or how we can help you..."
                      className="w-full px-4 py-3 rounded-xl border border-border bg-background text-foreground font-body placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all resize-none"
                    />
                  </div>

                  <button
                    type="submit"
                    disabled={isSubmitting}
                    className="w-full sm:w-auto flex items-center justify-center gap-2 bg-foreground text-background px-8 py-3.5 rounded-xl font-body font-medium hover:opacity-90 transition-opacity disabled:opacity-60"
                  >
                    <Send size={16} />
                    {isSubmitting ? "Sending..." : "Send Message"}
                  </button>
                </form>
              </div>
            </motion.div>
          </div>
        </div>
      </section>

      <Footer />
    </div>
  );
};

export default Contact;
