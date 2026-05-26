import Navbar from "@/components/Navbar";
import Footer from "@/components/Footer";
import ServicesSection from "@/components/ServicesSection";
import HolisticSection from "@/components/HolisticSection";
import CTASection from "@/components/CTASection";
import { motion } from "framer-motion";

const Services = () => {
  return (
    <div className="min-h-screen bg-background">
      <Navbar />
      
      <section className="pt-32 pb-12 px-6">
        <div className="max-w-6xl mx-auto">
          <motion.div
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            className="text-center"
          >
            <span className="text-primary font-body text-sm uppercase tracking-widest">Our Expertise</span>
            <h1 className="font-heading text-4xl md:text-5xl text-foreground mt-4 mb-6">
              Mental Health <span className="font-bold">Services</span>
            </h1>
            <p className="text-muted-foreground font-body max-w-2xl mx-auto text-lg">
              Comprehensive mental health support tailored to your unique needs. 
              Our team of certified therapists and psychiatrists are here to help you on your wellness journey.
            </p>
          </motion.div>
        </div>
      </section>

      <ServicesSection />
      <HolisticSection />
      <CTASection />
      
      <Footer />
    </div>
  );
};

export default Services;
