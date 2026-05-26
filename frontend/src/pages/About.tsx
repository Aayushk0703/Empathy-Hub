import Navbar from "@/components/Navbar";
import AboutSection from "@/components/AboutSection";
import CTASection from "@/components/CTASection";
import Footer from "@/components/Footer";

const About = () => {
  return (
    <div className="min-h-screen bg-background">
      <Navbar />
      <div className="pt-24"></div>
      <AboutSection />
      <CTASection />
      <Footer />
    </div>
  );
};

export default About;
