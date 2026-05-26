import Navbar from "@/components/Navbar";
import HeroSection from "@/components/HeroSection";
import AboutSection from "@/components/AboutSection";
import ServicesSection from "@/components/ServicesSection";
import HolisticSection from "@/components/HolisticSection";
import TestimonialsSection from "@/components/TestimonialsSection";
import TrustedBySection from "@/components/TrustedBySection";
import StatsSection from "@/components/StatsSection";
import ConditionsMarquee from "@/components/ConditionsMarquee";
import CTASection from "@/components/CTASection";
import BeliefMarquee from "@/components/BeliefMarquee";
import BlogSection from "@/components/BlogSection";
import Footer from "@/components/Footer";

const Index = () => {
  return (
    <div className="min-h-screen bg-background">
      <Navbar />
      <HeroSection />
      <AboutSection />
      <ServicesSection />
      <HolisticSection />
      <TestimonialsSection />
      <TrustedBySection />
      <StatsSection />
      <ConditionsMarquee />
      <CTASection />
      <BeliefMarquee />
      <BlogSection />
      <Footer />
    </div>
  );
};

export default Index;
