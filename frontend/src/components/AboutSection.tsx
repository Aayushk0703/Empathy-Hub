import { motion } from "framer-motion";
import aboutImg from "@/assets/holistic-healing.jpg";
import { Heart, Brain, Shield, Users, Award, Clock } from "lucide-react";

const features = [
  {
    icon: Heart,
    title: "Compassionate Care",
    desc: "We treat every individual with kindness, respect, and empathy in a safe environment.",
  },
  {
    icon: Brain,
    title: "Expert Team",
    desc: "Our licensed therapists and psychiatrists bring years of specialized experience.",
  },
  {
    icon: Shield,
    title: "Confidentiality",
    desc: "Your privacy is paramount. All sessions are completely confidential and secure.",
  },
  {
    icon: Users,
    title: "Community",
    desc: "Join a supportive community of individuals on similar wellness journeys.",
  },
  {
    icon: Award,
    title: "Proven Results",
    desc: "Our holistic approach has helped thousands achieve lasting mental wellness.",
  },
  {
    icon: Clock,
    title: " Flexible Scheduling",
    desc: "We offer convenient appointment times to fit your busy lifestyle.",
  },
];

const AboutSection = () => {
  return (
    <section className="py-20 px-4 bg-muted/30">
      <div className="max-w-6xl mx-auto">
        <motion.div
          initial={{ opacity: 0, y: 20 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
          className="text-center mb-14"
        >
          <h2 className="font-heading text-3xl md:text-5xl text-foreground">
            About <span className="font-bold text-primary">Spark Mental Health</span>
          </h2>
          <p className="text-muted-foreground font-body text-lg mt-2">
            Your trusted partner in mental wellness since 2015
          </p>
        </motion.div>

        <div className="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
          <motion.div
            initial={{ opacity: 0, x: -20 }}
            whileInView={{ opacity: 1, x: 0 }}
            viewport={{ once: true }}
            className="relative"
          >
            <img
              src={aboutImg}
              alt="About Spark Mental Health"
              className="rounded-2xl shadow-xl w-full h-auto object-cover"
loading="eager"
            />
            <div className="absolute -bottom-6 -right-6 bg-primary text-primary-foreground p-6 rounded-xl shadow-lg">
              <p className="font-heading text-3xl font-bold">1000+</p>
              <p className="text-sm">Lives Transformed</p>
            </div>
          </motion.div>

          <motion.div
            initial={{ opacity: 0, x: 20 }}
            whileInView={{ opacity: 1, x: 0 }}
            viewport={{ once: true }}
            className="space-y-6"
          >
            <h3 className="font-heading text-2xl text-foreground">
              A Holistic Approach to Mental Wellness
            </h3>
            <p className="text-muted-foreground font-body leading-relaxed">
              At Spark Mental Health, we believe in treating the whole person—not just the symptoms. 
              Our integrated approach combines evidence-based therapy, psychiatric care, and holistic 
              practices to address your unique needs and help you achieve lasting wellness.
            </p>
            <p className="text-muted-foreground font-body leading-relaxed">
              Founded by Dr. Sarah Mitchell, a board-certified psychiatrist with over 15 years of experience, 
              our clinic has become a trusted name in mental health care. We pride ourselves on creating 
              a warm, welcoming environment where every patient feels heard, valued, and supported.
            </p>

            <div className="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-4">
              {features.slice(0, 4).map((feature, i) => (
                <motion.div
                  key={feature.title}
                  initial={{ opacity: 0, y: 20 }}
                  whileInView={{ opacity: 1, y: 0 }}
                  viewport={{ once: true }}
                  transition={{ delay: i * 0.1 }}
                  className="flex items-start gap-3"
                >
                  <div className="w-10 h-10 rounded-full bg-primary/15 flex items-center justify-center flex-shrink-0">
                    <feature.icon size={20} className="text-primary" />
                  </div>
                  <div>
                    <h4 className="font-heading text-sm text-foreground">{feature.title}</h4>
                    <p className="text-xs text-muted-foreground">{feature.desc}</p>
                  </div>
                </motion.div>
              ))}
            </div>
          </motion.div>
        </div>

        <motion.div
          initial={{ opacity: 0, y: 20 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
          className="mt-16 grid grid-cols-2 md:grid-cols-4 gap-6"
        >
          <div className="text-center p-6 bg-background rounded-xl border border-border">
            <p className="font-heading text-3xl md:text-4xl font-bold text-primary">12+</p>
            <p className="text-muted-foreground text-sm mt-1">Years of Experience</p>
          </div>
          <div className="text-center p-6 bg-background rounded-xl border border-border">
            <p className="font-heading text-3xl md:text-4xl font-bold text-primary">50+</p>
            <p className="text-muted-foreground text-sm mt-1">Expert Therapists</p>
          </div>
          <div className="text-center p-6 bg-background rounded-xl border border-border">
            <p className="font-heading text-3xl md:text-4xl font-bold text-primary">98%</p>
            <p className="text-muted-foreground text-sm mt-1">Patient Satisfaction</p>
          </div>
          <div className="text-center p-6 bg-background rounded-xl border border-border">
            <p className="font-heading text-3xl md:text-4xl font-bold text-primary">24/7</p>
            <p className="text-muted-foreground text-sm mt-1">Support Available</p>
          </div>
        </motion.div>
      </div>
    </section>
  );
};

export default AboutSection;
