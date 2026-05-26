import { motion } from "framer-motion";
import holisticImg from "@/assets/holistic-healing.jpg";
import teenImg from "@/assets/teen-therapy.jpg";
import psychiatricImg from "@/assets/psychiatric-therapy.jpg";
import couplesImg from "@/assets/couples-therapy.jpg";
import { Heart, Zap, Sparkles, Shield } from "lucide-react";

const approaches = [
  {
    icon: Heart,
    title: "Holistic healing",
    desc: "Experience treatment that supports both your mind and body",
    image: holisticImg,
  },
  {
    icon: Zap,
    title: "Fast & lasting relief",
    desc: "Medication alleviates symptoms, while therapy builds lifetime skills.",
    image: teenImg,
  },
  {
    icon: Sparkles,
    title: "Enhanced well-being",
    desc: "Therapy provides insight, growth, and personal empowerment.",
    image: psychiatricImg,
  },
  {
    icon: Shield,
    title: "Lower relapse rates",
    desc: "Combined care reduces the chance of relapse & improves recovery.",
    image: couplesImg,
  },
];

const HolisticSection = () => {
  return (
    <section className="py-20 px-4">
      <div className="max-w-6xl mx-auto">
        <motion.div
          initial={{ opacity: 0, y: 20 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
          className="text-center mb-14"
        >
          <h2 className="font-heading text-3xl md:text-5xl text-foreground">
            We take a <span className="font-bold">Holistic Approach</span>
          </h2>
          <p className="text-muted-foreground font-body text-lg mt-2">to your mental wellness</p>
        </motion.div>

<div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
          {approaches.map((item, i) => (
            <motion.div
              key={item.title}
              initial={{ opacity: 0, y: 30 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true }}
              transition={{ delay: i * 0.1 }}
              className="rounded-2xl overflow-hidden bg-card border border-border group"
            >
              <div className="h-48 overflow-hidden">
<img
                  src={item.image}
                  alt={item.title}
                  className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                  loading="eager"
                  width={800}
                  height={533}
                />
              </div>
              <div className="p-6">
                <div className="w-10 h-10 rounded-full bg-primary/15 flex items-center justify-center mb-4">
                  <item.icon size={20} className="text-primary" />
                </div>
                <h3 className="font-heading text-xl text-foreground">{item.title}</h3>
                <p className="text-muted-foreground font-body text-sm mt-2 leading-relaxed">{item.desc}</p>
              </div>
            </motion.div>
          ))}
        </div>
      </div>
    </section>
  );
};

export default HolisticSection;
