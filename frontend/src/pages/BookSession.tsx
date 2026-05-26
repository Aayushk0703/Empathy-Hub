import { useState } from "react";
import Navbar from "@/components/Navbar";
import Footer from "@/components/Footer";
import { motion } from "framer-motion";
import { CalendarDays, Clock, CheckCircle } from "lucide-react";
import { apiRequest, type ApiError } from "@/lib/api";
import { toast } from "@/components/ui/sonner";

const services = [
  "Individual Therapy",
  "Couples Therapy",
  "Teen Therapy",
  "Psychiatric Consultation",
  "Family Therapy",
  "Group Therapy",
];

const sessionModes = ["Online (Video Call)", "In-Person", "Phone Call"];

const timeSlots = [
  "9:00 AM", "10:00 AM", "11:00 AM", "12:00 PM",
  "2:00 PM", "3:00 PM", "4:00 PM", "5:00 PM", "6:00 PM",
];

const BookSession = () => {
  const [isSubmitting, setIsSubmitting] = useState(false);
  const [formData, setFormData] = useState({
    fullName: "",
    email: "",
    phone: "",
    age: "",
    gender: "",
    service: "",
    sessionMode: "",
    preferredDate: "",
    preferredTime: "",
    alternateDate: "",
    alternateTime: "",
    previousTherapy: "",
    concerns: "",
    additionalNotes: "",
  });

  const handleChange = (e: React.ChangeEvent<HTMLInputElement | HTMLTextAreaElement | HTMLSelectElement>) => {
    setFormData({ ...formData, [e.target.name]: e.target.value });
  };

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();

    try {
      setIsSubmitting(true);
      const data = await apiRequest<{ message: string }>("/session-bookings", {
        method: "POST",
        body: JSON.stringify({
          full_name: formData.fullName,
          email: formData.email,
          phone: formData.phone,
          age: Number(formData.age),
          gender: formData.gender,
          service: formData.service,
          session_mode: formData.sessionMode,
          preferred_date: formData.preferredDate,
          preferred_time: formData.preferredTime,
          alternate_date: formData.alternateDate || null,
          alternate_time: formData.alternateTime || null,
          previous_therapy: formData.previousTherapy,
          concerns: formData.concerns,
          additional_notes: formData.additionalNotes || null,
        }),
      });

      toast.success(data.message);
      setFormData({
        fullName: "",
        email: "",
        phone: "",
        age: "",
        gender: "",
        service: "",
        sessionMode: "",
        preferredDate: "",
        preferredTime: "",
        alternateDate: "",
        alternateTime: "",
        previousTherapy: "",
        concerns: "",
        additionalNotes: "",
      });
    } catch (err) {
      toast.error((err as ApiError).message);
    } finally {
      setIsSubmitting(false);
    }
  };

  const inputClasses =
    "w-full px-4 py-3 rounded-xl border border-border bg-background text-foreground font-body placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all";

  return (
    <div className="min-h-screen bg-background">
      <Navbar />

      <section className="pt-32 pb-20 px-6">
        <div className="max-w-4xl mx-auto">
          <motion.div
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            className="text-center mb-16"
          >
            <span className="text-primary font-body text-sm uppercase tracking-widest">Book a Session</span>
            <h1 className="font-heading text-4xl md:text-5xl text-foreground mt-4 mb-6">
              Schedule Your Appointment
            </h1>
            <p className="text-muted-foreground font-body max-w-2xl mx-auto text-lg">
              Fill out the form below with your preferred date, time, and service. Our team will confirm your booking within a few hours.
            </p>
          </motion.div>

          <motion.div
            initial={{ opacity: 0, y: 30 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ delay: 0.2 }}
            className="bg-card rounded-3xl border border-border p-8 md:p-12"
          >
            <form onSubmit={handleSubmit} className="space-y-8">
              <div>
                <h2 className="font-heading text-xl text-foreground mb-1 flex items-center gap-2">
                  <span className="w-7 h-7 rounded-full bg-primary text-primary-foreground text-sm flex items-center justify-center font-body">1</span>
                  Personal Details
                </h2>
                <p className="font-body text-sm text-muted-foreground mb-5 ml-9">Tell us about yourself</p>
                <div className="grid sm:grid-cols-2 gap-5 ml-9">
                  <div>
                    <label className="block font-body text-sm text-foreground mb-2">Full Name <span className="text-destructive">*</span></label>
                    <input type="text" name="fullName" required value={formData.fullName} onChange={handleChange} placeholder="Enter your full name" className={inputClasses} />
                  </div>
                  <div>
                    <label className="block font-body text-sm text-foreground mb-2">Email Address <span className="text-destructive">*</span></label>
                    <input type="email" name="email" required value={formData.email} onChange={handleChange} placeholder="you@example.com" className={inputClasses} />
                  </div>
                  <div>
                    <label className="block font-body text-sm text-foreground mb-2">Phone Number <span className="text-destructive">*</span></label>
                    <input type="tel" name="phone" required value={formData.phone} onChange={handleChange} placeholder="+91 98765 43210" className={inputClasses} />
                  </div>
                  <div className="grid grid-cols-2 gap-4">
                    <div>
                      <label className="block font-body text-sm text-foreground mb-2">Age <span className="text-destructive">*</span></label>
                      <input type="number" name="age" required min="5" max="120" value={formData.age} onChange={handleChange} placeholder="25" className={inputClasses} />
                    </div>
                    <div>
                      <label className="block font-body text-sm text-foreground mb-2">Gender <span className="text-destructive">*</span></label>
                      <select name="gender" required value={formData.gender} onChange={handleChange} className={`${inputClasses} appearance-none`}>
                        <option value="" disabled>Select</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Non-binary">Non-binary</option>
                        <option value="Prefer not to say">Prefer not to say</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>

              <hr className="border-border" />

              <div>
                <h2 className="font-heading text-xl text-foreground mb-1 flex items-center gap-2">
                  <span className="w-7 h-7 rounded-full bg-primary text-primary-foreground text-sm flex items-center justify-center font-body">2</span>
                  Session Preferences
                </h2>
                <p className="font-body text-sm text-muted-foreground mb-5 ml-9">Choose your service and mode</p>
                <div className="grid sm:grid-cols-2 gap-5 ml-9">
                  <div>
                    <label className="block font-body text-sm text-foreground mb-2">Service Type <span className="text-destructive">*</span></label>
                    <select name="service" required value={formData.service} onChange={handleChange} className={`${inputClasses} appearance-none`}>
                      <option value="" disabled>Select a service</option>
                      {services.map((s) => (
                        <option key={s} value={s}>{s}</option>
                      ))}
                    </select>
                  </div>
                  <div>
                    <label className="block font-body text-sm text-foreground mb-2">Session Mode <span className="text-destructive">*</span></label>
                    <select name="sessionMode" required value={formData.sessionMode} onChange={handleChange} className={`${inputClasses} appearance-none`}>
                      <option value="" disabled>Select mode</option>
                      {sessionModes.map((m) => (
                        <option key={m} value={m}>{m}</option>
                      ))}
                    </select>
                  </div>
                </div>
              </div>

              <hr className="border-border" />

              <div>
                <h2 className="font-heading text-xl text-foreground mb-1 flex items-center gap-2">
                  <span className="w-7 h-7 rounded-full bg-primary text-primary-foreground text-sm flex items-center justify-center font-body">3</span>
                  Preferred Date & Time
                </h2>
                <p className="font-body text-sm text-muted-foreground mb-5 ml-9">Select your preferred and alternate slot</p>
                <div className="space-y-5 ml-9">
                  <div className="grid sm:grid-cols-2 gap-5">
                    <div>
                      <label className="block font-body text-sm text-foreground mb-2 flex items-center gap-1">
                        <CalendarDays size={14} /> Preferred Date <span className="text-destructive">*</span>
                      </label>
                      <input type="date" name="preferredDate" required value={formData.preferredDate} onChange={handleChange} className={inputClasses} />
                    </div>
                    <div>
                      <label className="block font-body text-sm text-foreground mb-2 flex items-center gap-1">
                        <Clock size={14} /> Preferred Time <span className="text-destructive">*</span>
                      </label>
                      <select name="preferredTime" required value={formData.preferredTime} onChange={handleChange} className={`${inputClasses} appearance-none`}>
                        <option value="" disabled>Select time slot</option>
                        {timeSlots.map((t) => (
                          <option key={t} value={t}>{t}</option>
                        ))}
                      </select>
                    </div>
                  </div>
                  <div className="grid sm:grid-cols-2 gap-5">
                    <div>
                      <label className="block font-body text-sm text-foreground mb-2 flex items-center gap-1">
                        <CalendarDays size={14} /> Alternate Date <span className="text-muted-foreground text-xs">(optional)</span>
                      </label>
                      <input type="date" name="alternateDate" value={formData.alternateDate} onChange={handleChange} className={inputClasses} />
                    </div>
                    <div>
                      <label className="block font-body text-sm text-foreground mb-2 flex items-center gap-1">
                        <Clock size={14} /> Alternate Time <span className="text-muted-foreground text-xs">(optional)</span>
                      </label>
                      <select name="alternateTime" value={formData.alternateTime} onChange={handleChange} className={`${inputClasses} appearance-none`}>
                        <option value="" disabled>Select time slot</option>
                        {timeSlots.map((t) => (
                          <option key={`alt-${t}`} value={t}>{t}</option>
                        ))}
                      </select>
                    </div>
                  </div>
                </div>
              </div>

              <hr className="border-border" />

              <div>
                <h2 className="font-heading text-xl text-foreground mb-1 flex items-center gap-2">
                  <span className="w-7 h-7 rounded-full bg-primary text-primary-foreground text-sm flex items-center justify-center font-body">4</span>
                  Additional Information
                </h2>
                <p className="font-body text-sm text-muted-foreground mb-5 ml-9">Help us prepare for your session</p>
                <div className="space-y-5 ml-9">
                  <div>
                    <label className="block font-body text-sm text-foreground mb-2">Have you had therapy before? <span className="text-destructive">*</span></label>
                    <div className="flex gap-4">
                      {["Yes", "No"].map((opt) => (
                        <label key={opt} className="flex items-center gap-2 cursor-pointer">
                          <input
                            type="radio"
                            name="previousTherapy"
                            value={opt}
                            required
                            checked={formData.previousTherapy === opt}
                            onChange={handleChange}
                            className="w-4 h-4 text-primary focus:ring-primary border-border"
                          />
                          <span className="font-body text-sm text-foreground">{opt}</span>
                        </label>
                      ))}
                    </div>
                  </div>
                  <div>
                    <label className="block font-body text-sm text-foreground mb-2">
                      Brief description of your concerns <span className="text-destructive">*</span>
                    </label>
                    <textarea
                      name="concerns"
                      required
                      rows={4}
                      value={formData.concerns}
                      onChange={handleChange}
                      placeholder="E.g., I've been feeling anxious lately and would like to talk to someone..."
                      className={`${inputClasses} resize-none`}
                    />
                  </div>
                  <div>
                    <label className="block font-body text-sm text-foreground mb-2">
                      Additional notes <span className="text-muted-foreground text-xs">(optional)</span>
                    </label>
                    <textarea
                      name="additionalNotes"
                      rows={3}
                      value={formData.additionalNotes}
                      onChange={handleChange}
                      placeholder="Any specific preferences, therapist gender preference, language, etc."
                      className={`${inputClasses} resize-none`}
                    />
                  </div>
                </div>
              </div>

              <div className="ml-9 pt-2">
                <button
                  type="submit"
                  disabled={isSubmitting}
                  className="w-full sm:w-auto flex items-center justify-center gap-2 bg-foreground text-background px-10 py-4 rounded-xl font-body font-medium hover:opacity-90 transition-opacity text-base disabled:opacity-60"
                >
                  <CheckCircle size={18} />
                  {isSubmitting ? "Submitting..." : "Book My Session"}
                </button>
                <p className="font-body text-xs text-muted-foreground mt-3">
                  Our team will confirm your appointment via email/phone within 2-4 hours.
                </p>
              </div>
            </form>
          </motion.div>
        </div>
      </section>

      <Footer />
    </div>
  );
};

export default BookSession;
