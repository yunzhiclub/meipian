package com.mengyunzhi.article.repository;

import javax.persistence.*;
import java.text.DecimalFormat;

/**
 * Created by Mr Chen on 2017/8/30.
 */
@Entity
public class Detail {
    @Id
    @GeneratedValue(strategy = GenerationType.AUTO)
    private Long id;
    private String type; // 类型
    private Integer number; // 数量
    private Integer frequency; // 频次
    private DecimalFormat unitPrice; // 单价
    private DecimalFormat totalPrice; //总价
    private String remark; // 备注
    @ManyToOne
    private Plan plan;

    public Detail(String type, Integer number, Integer frequency, DecimalFormat unitPrice, DecimalFormat totalPrice, String remark, Plan plan) {
        this.type = type;
        this.number = number;
        this.frequency = frequency;
        this.unitPrice = unitPrice;
        this.totalPrice = totalPrice;
        this.remark = remark;
        this.plan = plan;
    }
    public Detail(){

    }

    public Long getId() {
        return id;
    }

    public void setId(Long id) {
        this.id = id;
    }

    public String getType() {
        return type;
    }

    public void setType(String type) {
        this.type = type;
    }

    public Integer getNumber() {
        return number;
    }

    public void setNumber(Integer number) {
        this.number = number;
    }

    public Integer getFrequency() {
        return frequency;
    }

    public void setFrequency(Integer frequency) {
        this.frequency = frequency;
    }

    public DecimalFormat getUnitPrice() {
        return unitPrice;
    }

    public void setUnitPrice(DecimalFormat unitPrice) {
        this.unitPrice = unitPrice;
    }

    public DecimalFormat getTotalPrice() {
        return totalPrice;
    }

    public void setTotalPrice(DecimalFormat totalPrice) {
        this.totalPrice = totalPrice;
    }

    public String getRemark() {
        return remark;
    }

    public void setRemark(String remark) {
        this.remark = remark;
    }

    public Plan getPlan() {
        return plan;
    }

    public void setPlan(Plan plan) {
        this.plan = plan;
    }

    @Override
    public String toString() {
        return "Detail{" +
                "id=" + id +
                ", type='" + type + '\'' +
                ", number=" + number +
                ", frequency=" + frequency +
                ", unitPrice=" + unitPrice +
                ", totalPrice=" + totalPrice +
                ", remark='" + remark + '\'' +
                ", plan=" + plan +
                '}';
    }
}